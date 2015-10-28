<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'file'
    ];

    public function setFileAttribute($file) {
        $this->attributes['file_id'] = $file;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
