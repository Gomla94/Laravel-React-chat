<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    const ACTIVE_STATUS = 1;
    const BLOCK_STATUS = 0;
    
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
        'api_token',
        'unique_id',
        'last_name',
       
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
        'status' => 'integer',
        'date_of_birth' => 'date'
    ];

    public function receivesBroadcastNotificationsOn()
    {
        return 'user_notifications.'.$this->id;
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'from', 'unique_id');
    }

    public function subscribtions()
    {
        return $this->hasMany(Subscribtion::class, 'subscriber_id', 'unique_id');
    }

    public function subscribers()
    {
        return $this->hasMany(Subscribtion::class, 'user_id', 'unique_id');
    }

    public function subscribed($user_id)
    {
        return (bool)$this->subscribtions()->where('user_id', $user_id)->count();
    }

    public function isAdmin():bool
    {
        return $this->type === "admin";
    }
}
