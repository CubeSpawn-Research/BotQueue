<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Activity
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $activity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\User $user
 */
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
		return $this->belongsTo('App\User');
	}

	public function setUserAttribute($value) {
		$this->attributes['user_id'] = $value->id;
	}

}
