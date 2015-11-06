<?php

namespace App\Models;

use App\Models\File\FileInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property FileInterface file
 * @property string name
 * @property int queue_id
 * @property string status
 */
class Job extends Model
{
    protected $fillable = [
        'name',
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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bot()
    {
        return $this->belongsTo(Bot::class);
    }
}
