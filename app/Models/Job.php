<?php

namespace App\Models;

use App\Models\File\FileInterface;
use App\Models\File\LocalFile;
use App\Models\Traits\ConcurrentUpdates;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Job
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $queue_id
 * @property integer $file_id
 * @property string $name
 * @property string $status
 * @property integer $bot_id
 * @property float $progress
 * @property string $temperature_data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $version
 * @property \App\Models\File\LocalFile $file
 * @property \App\Models\Queue $queue
 * @property-read \App\User $user
 * @property-read \App\Models\Bot $bot
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Job available()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Job working()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Job failed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Job completed()
 */
class Job extends Model
{
    use ConcurrentUpdates;

    protected $fillable = [
        'name',
        'queue',
        'file'
    ];

    public function toArray()
    {
        $results = [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'queue' => '', // Fill in with api url
            'file' => '', // Fill in with api url
        ];

        return $results;
    }

    public function setFileAttribute(FileInterface $file) {
        $this->attributes['file_id'] = $file->id;
    }

    public function setQueueAttribute(Queue $queue)
    {
        $this->attributes['queue_id'] = $queue->id;
    }

    /**
     * @param Builder $query
     * @return $this
     */
    public static function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * @param Builder $query
     * @return $this
     */
    public static function scopeWorking($query)
    {
        return $query->where('status', 'taken');
    }

    /**
     * @param Builder $query
     * @return $this
     */
    public static function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * @param Builder $query
     * @return $this
     */
    public static function scopeCompleted($query)
    {
        // todo This needs to be ordered by date completed
        return $query->where('status', 'completed');
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }

    public function file()
    {
        return $this->belongsTo(LocalFile::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bot()
    {
        return $this->belongsTo(Bot::class);
    }
}
