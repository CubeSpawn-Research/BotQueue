<?php namespace App\Models;

use App\Models\Traits\ConcurrentUpdates;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bot
 *
 * @property string status
 * @property int id
 * @property integer $id
 * @property integer $user_id
 * @property integer $oauth_token_id
 * @property string $name
 * @property string $model
 * @property string $manufacturer
 * @property string $status
 * @property integer $job_id
 * @property string $error_text
 * @property integer $slice_config_id
 * @property string $temperature_data
 * @property string $driver_name
 * @property string $driver_config
 * @property integer $webcam_image_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $version
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Queue[] $queues
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
        return $this->belongsTo('App\User');
    }

    public function queues()
    {
        return $this->belongsToMany('App\Models\Queue')->withTimestamps();
    }

}
