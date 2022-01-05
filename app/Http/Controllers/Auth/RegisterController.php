<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InterestingType;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     public function showRegistrationForm()
     {
        $interesting_types = InterestingType::all();
        return view('auth.register', ['types' => $interesting_types]);
     }
     
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'type' => ['required', 'string', 'in:benefactor,user'],
            'phone_number' => ['numeric'],
            'interesting_type' => ['numeric', Rule::exists('interesting_types', 'id')],
            'additional_type' => ['sometimes', 'nullable', 'string', 'in:individual,organisation'],
            'organisation_description' => ['sometimes', 'nullable', 'string'],
            'api_token' => ['string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
            'phone_number' => $data['phone_number'],
            'interesting_type_id' => $data['interesting_type'] ?? null,
            'additional_type' => $data['additional_type'] ?? null,
            'organisation_description' => $data['organisation_description'] ?? null,
            'api_token' => str_random(60)
        ]);
    }
}
