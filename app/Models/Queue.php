<?php namespace App\Models;

use Auth;
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

    public function setDelayAttribute($value)
    {
        if($value == "")
            $value = 0;
        $this->attributes['delay'] = $value;
    }

    public function bots()
    {
        return $this->belongsToMany('App\Models\Bot')->withTimestamps();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

}
