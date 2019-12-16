<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'access_token', 'access_token_expired', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Forward a method call to the given object.
     *
     * @param  mixed  $object
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    protected function forwardCallTo($object, $method, $parameters)
    {
        if (in_array($method, ['create', 'update']) && isset($parameters[0]['password'])) {
            $parameters[0]['password'] = app('hash')->driver('bcrypt')->make($parameters[0]['password']);
        }
        return parent::forwardCallTo($object, $method, $parameters);
    }


}
