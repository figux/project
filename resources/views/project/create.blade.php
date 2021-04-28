@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        	<div class="col-sm-6">
        		@if($project->id != '')
            		<h1>Editar Proyecto</h1>
            	@else
            		<h1>Nuevo Proyecto</h1>
            	@endif
          	</div>
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="/dashboard">Volver a Proyectos</a></li>
              		
            	</ol>
          	</div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<section class="content-header">
    <div class="container-fluid">
		
		<div class="row" id="projectNameDiv">
            <div class="col-md-6">
				<div class="card card-primary">
              		<form>
			            <div class="card-body">
			                <div class="form-group">
			                	<label for="projectName">Nombre</label>
			                    <input type="text" class="form-control" id="projectName" >
			                    <input type="hidden" class="form-control" id="projectId" value="{{ $project->id }}" >
			                </div>
			                  
			            </div><!-- /.card-body -->
			            

			            
				            <div class="card-footer" id="wizardProject">
				                <button type="button" onclick="mostrarCapitulo()" class="btn btn-primary">Siguiente</button>
				            </div>

				        
				            <div class="card-footer ocultar" id="controlProject">
				                <button style="padding: 5px" onclick="guardarProjecto('actividad')" type="button" class="btn btn-primary">Actividad</button>
				                <button style="padding: 5px" onclick="guardarProjecto('capitulo')" type="button" class="btn btn-primary">Capítulo</button>
				                <button style="padding: 5px" onclick="guardarProjecto('proyecto')" type="button" class="btn btn-primary">Proyecto</button>
				            </div>
				        
		            </form>
            	</div>
            </div>
        </div><!-- end row -->


        <div class="row ocultar" id="chapterNameDiv">
            <div class="col-md-6">
				<div class="card card-primary">
              		<form>
			            <div class="card-body">
			                <div class="form-group">
			                	<label for="chapterName">Capítulo</label>
			                    <input type="text" class="form-control" id="chapterName" >
			                    <input type="hidden" class="form-control" id="chapterId" >
			                    <input type="hidden" class="form-control" id="chapterIndex" >
			                </div>
			                  
			            </div><!-- /.card-body -->
			            
				            <div class="card-footer" id="wizardChapter">
				                <button type="button" onclick="mostrarTareas()" class="btn btn-primary">Siguiente</button>
				            </div>
				        
				            <div class="card-footer ocultar" id="controlChapter">
				                <button style="padding: 5px" onclick="guardarCapitulo('actividad')" type="button" class="btn btn-primary">Actividad</button>
				                <button style="padding: 5px" onclick="guardarCapitulo('capitulo')" type="button" class="btn btn-primary">Capítulo</button>
				                <button style="padding: 5px" onclick="guardarCapitulo('proyecto')" type="button" class="btn btn-primary">Proyecto</button>
				            </div>
				        
		            </form>
            	</div>
            </div>
        </div><!-- end row -->


        <div class="row ocultar" id="tasksDiv">
            <div class="col-md-6">
				<div class="card card-primary">
              		<form>
			            <div class="card-body">


			            	<div id="controlTask">
			            		
			            		<p>Texto explicativo para dar claridad en los botones</p>
			            			
			            		<button onclick="mostrarFormularioTask('divSearchTask', 'controlTask')"  type="button" class="btn btn-primary">Buscar</button>
			            		<button onclick="mostrarFormularioTask('divCreateTask', 'controlTask');mostrarFormularioTask('footerButtonTask', 'controlTask');"  type="button" class="btn btn-primary">Crear</button>

			            	</div>

			            	<div id="divSearchTask" class="ocultar">
				            	<div class="form-group">
				                	<label for="taskName">Nombre Actividad</label>
				                    <input type="text" class="form-control" id="searchTaskName" >
				                </div>

				                <div class="form-group">
				                	<button  type="button" class="btn btn-primary">Buscar</button>
				                </div>


				                <table class="table table-bordered">
				                  <thead>
				                    <tr>
				                      <th>Task</th>
				                      <th>Label</th>
				                    </tr>
				                  </thead>
				                  <tbody>
				                    <tr>
				                      <td>1.</td>
				                      <td>Update software</td>
				                    </tr>
				                    <tr>
				                      <td>1.</td>
				                      <td>Update software</td>
				                    </tr>
				                    <tr>
				                      <td>1.</td>
				                      <td>Update software</td>
				                    </tr>
				                    
				                  </tbody>
				                </table>

				            </div>



			            	<div id="divCreateTask" class="ocultar">
				            	<div class="form-group">
				                	<label for="taskName">Actividad</label>
				                    <input type="text" required="required" class="form-control" id="taskName" >
				                    <input type="hidden" class="form-control" id="taskId" >
				                    <input type="hidden" class="form-control" id="taskIndex" >
				                    <input type="hidden" class="form-control" id="chapterBelong" >
				                </div>

				                <div class="form-group">
			                        <label>Capítulo</label>
			                        <select class="form-control" name="chaptersList" id="chaptersList">
			                        	
			                        </select>
		                      	</div>

		                      	<div class="form-group">
				                  	<label>Fecha de inicio:</label>
				                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
					                    <input type="text" id="start_date" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
					                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
					                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
					                    </div>
					                </div>
				                </div>

				                <div class="form-group">
				                	<label for="taskName">Duración</label>
				                    <input type="text" class="form-control" id="durationTask" >
				                </div>

				                <div class="form-group">
				                	<label for="taskName">Costo</label>
				                    <input type="text" class="form-control" id="costTask" >
				                </div>

				                <div class="form-check">
			                    	<input type="checkbox" value="1" class="form-check-input" id="publicTask">
			                    	<label class="form-check-label" for="exampleCheck1">Público</label>
			                  	</div>
				            </div>
			                  
			            </div><!-- /.card-body -->
			            

			            <div class="ocultar card-footer" id="footerButtonTask">
			                <button style="padding: 5px" onclick="guardarTarea('actividad')" type="button" class="btn btn-primary">Actividad</button>
			                <button style="padding: 5px" onclick="guardarTarea('capitulo')" type="button" class="btn btn-primary">Capítulo</button>
			                <button style="padding: 5px" onclick="guardarTarea('proyecto')" type="button" class="btn btn-primary">Proyecto</button>
			            </div>
		            </form>
            	</div>
            </div>
        </div><!-- end row -->



        <div class="row ocultar" id="projectTree">
            <div class="col-md-6">
				<div class="card card-primary">
              		
			            <div class="card-body">
			                

			            	<h1 id="projectNameTree"></h1>
			            	<br />
			            	<br />

			            	<div id="projectTreeList"></div>

			                  
			            </div><!-- /.card-body -->
			            
			            
				        <div class="card-footer">
				                <button type="button" onclick="guardarData()" class="btn btn-primary">Guardar</button>
				                <button type="button" onclick="mostrarFormularioTask('chapterNameDiv', 'projectTree')" class="btn btn-primary">Capítulo</button>
				                <button type="button" onclick="mostrarFormularioTask('controlTask', 'projectTree');mostrarFormularioTask('tasksDiv', 'projectTree')" class="btn btn-primary">Actividad</button>
				        </div>
				        
		            </form>
            	</div>
            </div>
        </div><!-- end row -->

    </div>
</section>



@endsection



@section('scripts')
    <script type="text/javascript">

    	var json_data = {!! $json_data !!};
    	var chapterName = '';

    	if(json_data.project != undefined){
    		$('#projectNameDiv').hide();
    		crearArbol(true);
    		$('#projectTree').show();

    		//Mostramos los botones no el wizard
    		$('#wizardProject').hide();
    		$('#wizardChapter').hide();
    		$('#controlChapter').show();
    		$('#controlProject').show();
    		
    		
    	}

    	$('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
		});

		function guardarData(){
			
			$.ajax({
              method: "POST",
              url: "{{url('/saveProjectSetup')}}",
              data: JSON.stringify(json_data),
              success: function (data){

              	if(data >= 0){

              		Swal.fire({
					  	title: 'Guardando...',
						text: "Proyecto guardado existosamente",
						icon: 'success',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ok'
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.replace("/project/"+data);
					  	}
					})

              		
              	}else{
              		Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Algo ha salido mal, intentelo nuevamente!',
					});
              	}
                
              }
            });

		}

		function deleteItemData(obj, id, projectId){

			Swal.fire({
			  title: '¿Esta seguro de borrar el recurso?',
			  showDenyButton: true,
			  showCancelButton: false,
			  confirmButtonText: `Eliminar`,
			  denyButtonText: `Cancelar`,
			}).then((result) => {
			  /* Read more about isConfirmed, isDenied below */
			  if (result.isConfirmed) {
			    

			  	$.ajax({
	              method: "POST",
	              url: "{{url('/deleteProjectItem')}}",
	              data: JSON.stringify({"obj": obj, "id": id, "projectId": projectId}),
	              success: function (data){

	              	console.log(data);

	              	if(data == 'OK'){

	              		Swal.fire({
						  	title: 'Guardando...',
							text: "Proyecto guardado existosamente",
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.replace("/project/"+projectId);
						  	}
						})


	              	}else{
	              		Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: 'Algo ha salido mal, intentelo nuevamente!',
						});
	              	}
	                
	                
	              }
	            });


			  } else if (result.isDenied) {
			    
			    Swal.fire('Changes are not saved', '', 'info')

			  }
			})
			
			

		}

		function crearBoton(option, id, projectId){

			let optionName = option.split(',');

			return `<button class="btn btn-app customButton" onclick="editarDatos('${option}')"><i class="fas fa-edit"></i> </button>
			<button onclick="deleteItemData('${optionName[0]}', ${id}, ${projectId})" class="btn btn-app customButton"><i class="fas fa-inbox"></i> </button>`;

		}

		function ocutarTodo(){
			$('#projectNameDiv').hide();
    		$('#chapterNameDiv').hide();
    		$('#tasksDiv').hide();
    		$('#projectTree').hide();
    		$('#controlTask').hide();
		}

		function editarDatos(option){
			//mostramos el formulario a editar
			ocutarTodo();
			let params = option.split(',');
			option = params[0];
			let i = params[1];
			let j = params[2];
			
			switch(option){
				case "project":
					$('#projectName').val(json_data.project.name);
					$('#projectNameDiv').show();
				break;
				case "chapter":

					$('#chapterName').val(json_data.project.chapters[i].name);
					$('#chapterId').val(json_data.project.chapters[i].id);
					$('#chapterIndex').val(i);
					
					$('#chapterNameDiv').show();
				break;
				case "task":

					let task = json_data.project.chapters[i].tasks[j];
					
					$('#taskName').val(task.name);
					$('#taskId').val(task.id);
					$('#taskIndex').val(j);
					$('#chaptersList').val(i);
					$('#start_date').val(task.start_date);
					$('#durationTask').val(task.duration);
					$('#costTask').val(task.cost);
					$('#chapterBelong').val(i);

					$('#tasksDiv').show();
					$('#divCreateTask').show();
					$('#footerButtonTask').show();
					

				break;
			}

		}

		function crearArbol(chapterInTaskForm){

			//Titulo del proyecto
			$('#projectNameTree').html(json_data.project.name + crearBoton("project", json_data.project.id, json_data.project.id));

			let numChapters = json_data.project.chapters.length;
			let html = '<table>';
			for (let i = 0; i < numChapters; i++) {

				if(chapterInTaskForm){
					$('#chaptersList').append('<option id="chapterIndex-'+ i +'" value='+ i +'>'+json_data.project.chapters[i].name+'</option>');	
				}

				html += '<tr><td style="width: 70%"><h2>'+json_data.project.chapters[i].name  + '</h2></td><td>'+crearBoton("chapter,"+i, json_data.project.chapters[i].id, json_data.project.id)+"</td></tr>";
				if(json_data.project.chapters[i].tasks.length > 0){
					let numChapterTask = json_data.project.chapters[i].tasks.length;
					
					for (let j = 0;j < numChapterTask; j++) {
						html += '<tr><td>'+ json_data.project.chapters[i].tasks[j].name +" </td><td>" + crearBoton("task,"+i+","+j,json_data.project.chapters[i].tasks[j].id, json_data.project.id) +'</td></tr>';
					}
					
				}
			}

			html += "</table>";
			$('#projectTreeList').html(html);
		}
    
    	function mostrarCapitulo(){
    		let projectName = $('#projectName').val();
    		if(projectName != ""){
    			
    			//primera vez
    			if($('#projectId').val() == ""){
    				json_data.project = {"name": projectName, "id": -1};
    				$('#projectId').val(-1);
    			}else{
    			//actualizando
    				json_data.project.name = projectName;
    				console.log(json_data);
    			}

    			//ocultamos el formulario del proyecto
    			$('#projectNameDiv').hide();
    			//mostramos el formulario de los capitulos
    			$('#chapterNameDiv').show();
    		}else{
    			alert("Para continuar digite el nombre del proyecto");
    		}
    		
    	}

    	function mostrarTareas(){
    		chapterName = $('#chapterName').val();
    		let chapterId = $('#chapterId').val();
    		let chapterIndex = $('#chapterIndex').val();
    		
    		$('#chapterName').val("");
    		$('#chapterId').val("");
    		$('#chapterIndex').val("");
    		
    		if(chapterName != ""){
    			
    			if(json_data.project.chapters == undefined){
    				json_data.project.chapters = [];
    			}
    			
    			if(chapterIndex != ""){

    				json_data.project.chapters[chapterIndex].name = chapterName;
					//actualizar el combobox
					$('#chapterIndex-'+chapterIndex).text(chapterName);

    			}else{
    				json_data.project.chapters.push({"name": chapterName, "id": -1,"tasks": []});
	    			//Agregamos el capitulo a la lista de capitulos de las tareas
	    			chapterIndex = json_data.project.chapters.length - 1;
	    			$('#chaptersList').append('<option id="chapterIndex-'+ chapterIndex +'" value='+ chapterIndex +'>'+chapterName+'</option>');	
    			}
    			

    			//ocultamos el formulario de los capitulos
    			$('#chapterNameDiv').hide();
    			//mostramos el formulario de las tareas
    			$('#tasksDiv').show();
    			$('#controlTask').show();
    		}else{
    			alert("Para continuar digite el nombre del capítulo");
    		}
    	}

    	function mostrarFormularioTask(mostrar, ocultar){
    		$('#'+ocultar).hide();
    		$('#'+mostrar).show();
    	}

    

    	function guardarProjecto(redirect){
    		
    		mostrarCapitulo();
			ocutarTodo();


    		switch(redirect){
	    		case "actividad":
	    			$('#tasksDiv').show();
	    		break;
	    		case "capitulo":
	    			$('#chapterNameDiv').show();
	    		break;
	    		case "proyecto":
	    			crearArbol(false);

	    			$('#projectTree').show();
	    		break;
	    	}
    	}

    	function guardarCapitulo(redirect){

    		//Actualizamos el listado de capitulos con el nuevo nombre

    		mostrarTareas();
			ocutarTodo();


    		switch(redirect){
	    		case "actividad":
	    			$('#tasksDiv').show();
	    			$('#controlTask').show();
	    		break;
	    		case "capitulo":
	    			$('#chapterNameDiv').show();
	    		break;
	    		case "proyecto":
	    			crearArbol(false);
	    			$('#projectTree').show();
	    		break;
	    	}
    	}

    	function guardarTarea(redirect){

    		let task = {
    			"id": $('#taskId').val() == "" ? -1 : $('#taskId').val(),
    			"name": $('#taskName').val(),
    			"public": $('#publicTask').is(":checked"),
    			"start_date": $('#start_date').val(),
    			"duration": $('#durationTask').val(),
    			"cost": $('#costTask').val()
    		};

    		let taskIndex = $('#taskIndex').val();
    		let chapterIndex = $('#chaptersList').val();
    		let chapterBelong = $('#chapterBelong').val();

    		//limpiamos la data del formulario
    		$('#taskName').val("");
    		$('#start_date').val("");
    		$('#durationTask').val("");
    		$('#costTask').val("");
    		$('#taskIndex').val("");
    		$('#chapterBelong').val("");


    		if(chapterIndex >= 0){

    			if(taskIndex != "" && chapterBelong == chapterIndex){
    				json_data.project.chapters[chapterIndex].tasks[taskIndex] = task;
    				
    			}else{
    				json_data.project.chapters[chapterIndex].tasks.push(task);	
    			}

    			//Revisamos si debemos borrar la tarea en otro capitulo, solo ocurre cuando se actualiza de un capitulo a otro
    			if(chapterBelong != ""  && chapterBelong != chapterIndex){
    				json_data.project.chapters[chapterBelong].tasks.splice(taskIndex, 1);
    			}
    			

    			$('#divSearchTask').hide();
	    		$('#divCreateTask').hide();
	    		$('#footerButtonTask').hide();
	    		$('#controlTask').show();
	    		$('#tasksDiv').hide();
	    		

	    		switch(redirect){
	    			case "actividad":
	    				$('#tasksDiv').show();
	    			break;
	    			case "capitulo":
	    				$('#chapterNameDiv').show();
	    			break;
	    			case "proyecto":
	    				crearArbol(false);

						$('#wizardProject').hide();
	    				$('#controlProject').show();

	    				$('#wizardChapter').hide();
	    				$('#controlChapter').show();
	    				$('#projectTree').show();
	    			break;
	    		}
    		}else{
    			alert("Ha ocurrido un error");
    		}
    		

    	}


    </script>
@endsection