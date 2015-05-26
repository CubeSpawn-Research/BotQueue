<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activities';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'activity'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
		'user_id',
		'user',
		'updated_at'
	];

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function setUserAttribute($value) {
		$this->attributes['user_id'] = $value->id;
	}

}
