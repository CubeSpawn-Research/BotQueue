<?php

namespace App\Models;

use App\Models\File\FileInterface;
use App\Models\File\LocalFile;
use App\Models\Traits\ConcurrentUpdates;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string status
 *
 * @property int queue_id
 * @property Queue queue
 * @property int file_id
 * @property FileInterface file
 * @property int user_id
 * @property User user
 * @property string temperature_data
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
