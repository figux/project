<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function task()
    {
        return $this->belongsToMany(Task::class, 'chapter_has_task')->withPivot('id', 'start_date', 'duration', 'cost');
    }
}
