<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ACTIVE_STATUS = 1;
    const BLOCK_STATUS = 0;

    const STATUSES = [1 => 'active', 0 => 'blocked'];
    
    const USER_TYPE = 'user';
    const ADMIN_TYPE = 'admin';
    const BENEFACTOR_TYPE = 'benefactor';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
        'image',
        'phone_number',
        'interesting_type_id',
        'additional_type',
        'organisation_description',
        'date_of_birth',
        'age'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'integer'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function appeals()
    {
        return $this->hasMany(Appeal::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
