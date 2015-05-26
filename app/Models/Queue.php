<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'queues';

	/**
	 *  Don't use timestamps
	 *
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'delay'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'user_id',
		'user',
	];

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function setUserAttribute($value) {
		$this->attributes['user_id'] = $value->id;
	}

}
