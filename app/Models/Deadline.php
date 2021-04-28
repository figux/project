<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    use HasFactory;

    public function traces(){
    	 return $this->hasMany(Trace::class);
    }

    public function project(){
    	return $this->belongsTo(Project::class);
    }
}
