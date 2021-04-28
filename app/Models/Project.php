<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    public function createProjectTree(){


    	$chapters = $this->chapters;
    	$numChapters = count($chapters);
    	$json_data['project']['name'] = $this->name;
    	$json_data['project']['id'] = $this->id;
    	$json_data['project']['chapters'] = [];

    	for($i=0; $i < $numChapters; $i++){
    		$chapter = $chapters[$i];
    		$json_data['project']['chapters'][$i]['name'] = $chapter->name;
    		$json_data['project']['chapters'][$i]['id'] = $chapter->id;
    		$json_data['project']['chapters'][$i]['tasks'] = [];

			$tasks = $chapter->task;
    		$numTask = count($tasks);
    		for($j=0; $j < $numTask; $j++){
    			$task = $tasks[$j];
    			
    			$json_data['project']['chapters'][$i]['tasks'][$j]['id'] = $task->pivot->id;
    			$json_data['project']['chapters'][$i]['tasks'][$j]['name'] = $task->name;
    			$json_data['project']['chapters'][$i]['tasks'][$j]['public'] = $task->public;
    			$json_data['project']['chapters'][$i]['tasks'][$j]['start_date'] = $task->pivot->start_date;
    			$json_data['project']['chapters'][$i]['tasks'][$j]['duration'] = $task->pivot->duration;
    			$json_data['project']['chapters'][$i]['tasks'][$j]['cost'] = $task->pivot->cost;

    		}
    	}

    	return json_encode($json_data);

    }

    public function deadlines(){
         return $this->hasMany(Deadline::class);
    }


    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }


     public function user()
    {
        return $this->belongsTo(User::class);
    }


}
