<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterHasTask extends Model
{
    use HasFactory;

    protected $table = 'chapter_has_task';

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    
}
