<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bots';

	protected $fillable = [
		'name',
		'model',
		'manufacturer',
		'status',
		'error_text',
		'driver_name',
		'driver_config'
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

    public function queues()
    {
        return $this->belongsToMany('App\Models\Queue')->withTimestamps();
    }

}
