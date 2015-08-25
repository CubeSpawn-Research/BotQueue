<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

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
		'username',
		'password',
		'email',
		'dashboard_style',
		'thingiverse_token'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'thingiverse_token',
        'remember_token',
		'dashboard_style',
		'last_notification',
		'email',
		'created_at',
		'updated_at',
		'activities', #todo Convert this into the url
		'queues', #todo Convert this into the url
	];

	protected $casts = [
		'is_admin' => 'boolean'
	];

	/**
	 * The attributes to add to the model's JSON form.
	 *
	 * @var array
	 */
	protected $appends = [
		'registered',
		'last_seen'
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
