<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function chapter()
    {
        return $this->belongsToMany(Chapter::class, 'chapter_has_task')->withPivot('id','start_date', 'duration', 'cost');
    }
}
