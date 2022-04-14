<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InterestingType;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
    protected $redirectTo = '/chat';

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ],
            [
                'name.required' => __('translations.required.error'),
                'name.max' => __('translations.max.error'),
                'email.required' => __('translations.required.error'),
                'email.email' => __('translations.email.error'),
                'email.max' => __('translations.max.error'),
                'password.required' => __('translations.required.error'),
                'password.min' => __('translations.min.error'),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */

    function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }


    protected function create(array $data)
    {
     
        $full_name = request('name') . ' ' . request('last_name');
        $img = \A6digital\Image\Facades\DefaultProfileImage::create($full_name, 256, $this->rand_color(), '#FFF');
        $default_image = Storage::disk('s3')->put("defaultProfileImages/{$full_name}.png", $img->encode());
        $image_path = Storage::disk('s3')->url("defaultProfileImages/{$full_name}.png");

        $user = User::create([
            'name' => ucfirst($data['name']),
            'last_name' => ucfirst($data['last_name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'user',
            'image' => $image_path,
            'api_token' => str_random(60),
            'unique_id' => str_random(60)
        ]);

        return $user;
    }
}
