<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    use HasFactory;


    public function deadline(){
    	return $this->belongsTo(Deadline::class);
    }

    

}
