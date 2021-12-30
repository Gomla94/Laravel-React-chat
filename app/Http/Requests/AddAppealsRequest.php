<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AddAppealsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'appeal_title' => ['required', 'string'],
            'appeal_description' => ['sometimes', 'nullable', 'string'],
            'appeal_image' => ['max:2048', 'array'],
            'appeal_image.*' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'appeal_video' => ['max:20168', 'mimes:mp4,mov,ogg,qt'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            $validator->after(function (Validator $validator) {
                $validator->errors()->add('modalType', 'appealsModal');
            });
        }
    }
}
