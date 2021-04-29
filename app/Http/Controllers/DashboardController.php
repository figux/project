<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;
use App\Models\Chapter;
use App\Models\Task;
use App\Models\ChapterHasTask;
use App\Models\Deadline;
use App\Models\Trace;

//


class DashboardController extends Controller
{
    
	
    public function index(){

    	$myProjects = Project::where('user_id',Auth::user()->id)->get();

        return view('dashboard', ['projects' => $myProjects]);

    } 

    public function projectForm($id=""){

        $project = $this->createObj('Project', $id);

        if($id == ""){
            $json_data = '{}';
        }else{
            $json_data = $project->createProjectTree();
        }
    	

    	return view('project.create', ['json_data' => $json_data, 'project' => $project]);
    }

    private function createObj($objClass, $id){

        $objClass = "App\Models\\".$objClass;

        if( is_numeric($id) && $id > 0){
            $obj = $objClass::find($id);
        }else{
            $obj = new $objClass();    
        }

        return $obj;
    }

    public function deleteProjectItem(Request $request){

        $data = (object) $request->json()->all();


        switch ($data->obj) {
            case 'project':
                # code...
                $project = Project::find($data->id);
                $chapters = $project->chapters;
                foreach ($chapters as $chapter) {
                    ChapterHasTask::where('chapter_id',$chapter->id)->delete();
                    Chapter::where('id',$chapter->id)->delete();
                }
                
                Project::where('id',$data->id)->delete();
            break;
            case 'chapter':
                # code...
                ChapterHasTask::where('chapter_id',$data->id)->delete();
                Chapter::where('id',$data->id)->delete();
            break;
            case 'task':
                ChapterHasTask::where('id',$data->id)->delete();

            break;
        }

        return "OK";

    }

    public function saveProjectSetup(Request $request){

    	$data = (object) $request->json()->all();

        //Proyecto
        $project = $this->createObj('Project', $data->project['id']);
    	
    	$project->name = $data->project['name'];
    	$project->user_id = Auth::user()->id;
    	$project->save();

    	foreach ($data->project['chapters'] as $cap) {

    		//$chapter = new Chapter();
            $chapter = $this->createObj('Chapter', $cap['id']);
    		$chapter->project_id = $project->id;
    		$chapter->name = $cap['name'];
    		$chapter->save();

    		foreach ($cap['tasks'] as $task) {
                
                $beetweenTable = $this->createObj('ChapterHasTask', $task['id']);

                if($task['id'] == -1){
        			$taskdb = new Task();
        			
        		}else{
                    $taskdb = Task::find($beetweenTable->task_id);
                }

                $taskdb->name  = $task['name'];
                $taskdb->public = $task['public'];
                $taskdb->start_date = $task['start_date'];
                $taskdb->duration = $task['duration'];
                $taskdb->cost = $task['cost'];

                $taskdb->save();

                $beetweenTable->chapter_id = $chapter->id;
                $beetweenTable->task_id = $taskdb->id;

    			//$beetweenTable = new ChapterHasTask();
    			
    			$beetweenTable->start_date = $task['start_date'];
    			$beetweenTable->duration = $task['duration'];
    			$beetweenTable->cost = $task['cost'];
    			$beetweenTable->save();

    			unset($beetweenTable);
    			unset($taskdb);

    		}


    		unset($chapter);
    		
    	}

    	return $project->id;



    }//End Function

    public function deadlineProject($id){

        //Verificamos q sea dueño del proyecto
        $project = Project::where('id',$id)->where('user_id',Auth::user()->id)->first();

        return view('project.trace', ['project' => $project]);

    }

    public function saveDeadline(Request $request){

        $project = Project::find($request->project_id);

        $deadline = new Deadline();
        $deadline->deadline = $request->start_date;
        $deadline->project_id = $request->project_id;
        $deadline->save();

        $chapters = $project->chapters;
        $numChapters = count($chapters);

        $date2=date_create($deadline->deadline);

        for($i=0; $i < $numChapters; $i++){
            $chapter = $chapters[$i];
            $tasks = $chapter->task;
            $numTask = count($tasks);
            for($j=0; $j < $numTask; $j++){
                $task = $tasks[$j];

                //Solo guardamos las tareas que esten en ejecución o hayan sido terminadas a la fecha deadline
                if($task->pivot->start_date <= $deadline->deadline){

                    $trace = new Trace();
                    $trace->chapter_has_task_id = $task->pivot->id;
                    $trace->deadline_id = $deadline->id;
                    $trace->real_duration = 0;
                    $trace->real_cost = 0;

                    //Calculamos la duracion y costos estimados
                    $date1=date_create($task->pivot->start_date);
                    $diff=date_diff($date1,$date2);
                    $daysUntilToday = $diff->format("%R%a");
                    
                    $trace->estimated_duration = number_format(($daysUntilToday / $task->pivot->duration) * 100, 2, '.', '');

                    if($trace->estimated_duration > 100){
                        $trace->estimated_duration = 100;
                    }

                    $trace->estimated_cost = ($task->pivot->cost / $task->pivot->duration) * $daysUntilToday;

                    if($trace->estimated_cost > $task->pivot->cost){
                        $trace->estimated_cost = $task->pivot->cost;
                    }

                    $trace->save();
                    unset($trace);

                }
                    
                
            }
        }

        return redirect()->route('tracing', ['id' => $request->project_id]);

    }//end function

    public function deleteDeadline($deadline_id){

        //Integridad referencial, debemos borrar primero las traces y luego la deadline
        $affectedRows = Trace::where('deadline_id', $deadline_id)->delete();
        $deadline = Deadline::find($deadline_id);
        $project_id = $deadline->project_id;
        $deadline->delete();

        return redirect()->route('tracing', ['id' => $project_id]);


    }


    /*
    *
    *  Función que calcula la programación a día de hoy
    */
    function atToday($deadline_id){
        $traces = Trace::where('deadline_id', $deadline_id)->get();
        $responseDataArray = [];
        $today = date('Y-m-d');

        foreach ($traces as $trace) {
            $cht = ChapterHasTask::find($trace->chapter_has_task_id);

            $data['chapter'] = $cht->chapter->name;
            $data['task'] = $cht->task->name;
            $data['estimated_duration'] = 0;
            $data['estimated_cost'] = 0;
            $data['estimated_cost_value'] = 0;
            $data['real_duration'] = ($trace->real_duration == '') ? 0: $trace->real_duration;
            $data['real_cost'] = ($trace->real_cost == '') ? 0 : $trace->real_cost;
            $data['real_cost_value'] = ($trace->real_cost == '') ? 0 : $trace->real_cost;


            //echo $cht->start_date." ---- ".$today."<br />";

            if($cht->start_date <= $today){
                //Calculamos la duracion y costos estimados
                $date1=date_create($cht->start_date);
                $date2=date_create($today);
                $diff=date_diff($date1,$date2);
                $daysUntilToday = $diff->format("%R%a");
                
                $data['estimated_duration'] = number_format(($daysUntilToday / $cht->duration) * 100, 2, '.', '');
                $data['estimated_cost'] = number_format(((($cht->cost / $cht->duration) * $daysUntilToday) / $cht->cost) * 100, 2, '.', '');
                $data['estimated_cost_value'] = number_format(($cht->cost / $cht->duration) * $daysUntilToday, 2, ',', '.');
            }

            $responseDataArray[] = $data;

            unset($data);
            unset($cht);
        }
        

        return view('project.detail-trace', ['traces' => $responseDataArray]);
    }

    /*
    *
    *  Función que calcula las estimaciones a la fecha del deadline
    */
    function showTrace($deadline_id, $view=1){

        $viewName = 'project.detail-trace';

        $traces = Trace::where('deadline_id', $deadline_id)->get();
        $responseDataArray = [];
        $today = date('Y-m-d');
        $viewTitle = 'Mix Data';
        $project_id = 0;


        foreach ($traces as $trace) {
            $cht = ChapterHasTask::find($trace->chapter_has_task_id);

            $data['chapter'] = $cht->chapter->name;
            $project_id = $cht->chapter->project_id;
            $data['task'] = $cht->task->name;


            if($view == 2){
                $data['duration'] = $trace->estimated_duration;
                $data['cost'] = $trace->estimated_cost;
                $viewTitle = 'Programación';
            }else if($view == 3){
                $data['duration'] = $trace->real_duration;
                $data['cost'] = $trace->real_cost;
                $viewTitle = 'Seguimiento';
            }

            $data['estimated_duration'] = $trace->estimated_duration;
            $data['estimated_cost'] = $trace->estimated_cost;
            $data['real_duration'] = $trace->real_duration;
            $data['real_cost'] = $trace->real_cost;
            
            $data['real_cost_value'] = 0;
            $data['estimated_cost_value'] = 0;

            $responseDataArray[] = $data;

            unset($data);
            unset($cht);
        }

        if($view != 1){
            $viewName = 'project.program-trace';
        }
        

        return view($viewName, ['traces' => $responseDataArray, 'viewTitle' => $viewTitle, 'project_id' => $project_id]);
        

    }//end function

    
}//End class
