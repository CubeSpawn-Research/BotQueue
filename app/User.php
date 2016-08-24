<?php

namespace App;

use App\Models\Traits\ConcurrentUpdates;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, ConcurrentUpdates;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getRegisteredAttribute()
    {
        return $this->created_at;
    }

    public function getLastSeenAttribute()
    {
        return $this->updated_at;
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function queues()
    {
        return $this->hasMany('App\Models\Queue');
    }

    public function bots()
    {
        return $this->hasMany('App\Models\Bot');
    }
}
