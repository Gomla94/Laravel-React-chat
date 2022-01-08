<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserResource extends BaseResource
{
    public static function collection($resource)
    {
        return tap(new UserCollection($resource), function ($collection) {
            $collection->collects = __CLASS__;
        });
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request):array
    {
        return $this->filterFields([
            'id' => $this->id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'type' => $this->type,
            "status" => $this->status,
            "age" => $this->age,
            "gender" => $this->gender,
            "date_of_birth" => $this->date_of_birth,
            "organisation_description" => $this->organisation_description,
            'image' => $this->image ? Storage::disk('public')->url($this->image) : null,
            'email_verified' => $this->email_verified_at ? true : false,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            "additional_type" => $this->additional_type,
            "country" => CountryResource::make($this->whenLoaded('country'))->hide([
                'created_at',
                'updated_at'
            ]),

            // TODO
            // implement relational loading after changing many to many
            "interesting_type_id" => $this->interesting_type_id,
        ]);
    }
}
