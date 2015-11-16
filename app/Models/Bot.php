<?php namespace App\Models;

use App\Models\Traits\ConcurrentUpdates;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string status
 * @property int id
 */
class Bot extends Model
{

	use ConcurrentUpdates;

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
