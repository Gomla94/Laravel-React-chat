<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:18','confirmed'],
            'password_confirmation' => ['string','min:8','max:18'],
            'type' => ['string', 'in:benefactor,user'],
            'phone_number' => ['numeric'],
            'interesting_type' => ['numeric', Rule::exists('interesting_types', 'id')],
            'additional_type' => ['sometimes', 'nullable', 'string', 'in:individual,organisation'],
            'organisation_description' => ['sometimes', 'nullable', 'string'],
            'api_token' => ['string']
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages():array
    {
        return [
            'password.confirmed' => __("AuthApi.mustBe.passwordConfirmed"),
            'name.required' => __("AuthApi.mustBe.required"),
            'email.email' => __("AuthApi.mustBe.email"),
            'password.required' => __("AuthApi.mustBe.required"),
            'password.min' => __("AuthApi.mustBe.passwordLenMin"),
            'password.max' => __("AuthApi.mustBe.passwordLenMax"),
        ];
    }
}
