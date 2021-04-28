@extends('layouts.adminlte')

@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        	<div class="col-sm-6">
        		Seguimientos
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

    	<div class="row" id="deadlineListDiv">

	    	<div class="col-md-6">
				
				<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Seguimientos a {{$project->name}}</h3>
	              	</div>
	              	<!-- /.card-header -->
	             	
	             	<div class="card-body">

	                	<button onclick="mostrarFormulario()" class="btn btn-primary btn-block">Crear Seguimiento</button><br />

		                @if(count($project->deadlines) > 0)
		                      
			                <table class="table table-bordered">
			                  <thead>
			                    <tr>
			                      <th>Fecha</th>
			                      <th>Opciones</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                    @foreach($project->deadlines as $deadline)
			                    <tr>
			                      <td>
			                        <a href="/trace/{{$deadline->id}}">{{ $deadline->deadline }}</a>
			                      </td>
			                      <td>
			                      	<a href="/trace/{{$deadline->id}}/2"> Prog </a> | 
			                      	<a href="/trace/{{$deadline->id}}/3"> Seg </a> | 
			                        <a href="/deleteDeadline/{{$deadline->id}}"> X </a>
			                      </td>
			                    </tr>
			                    @endforeach
			                  </tbody>
			                </table>
		                @endif
		                    
	                      
	              	</div>
	              	<!-- /.card-body -->
	              
	            </div>
	            <!-- /.card -->

	            
	        </div><!-- /col-6 -->
	    </div>

    	


		
		<div class="row ocultar" id="deadlineFormDiv">
            <div class="col-md-6">
				<div class="card card-primary">
              		<form action="/saveDeadline" name="fromTrace" method="post">

              			@csrf

			            <div class="card-body">
			                <div class="form-group">
				                <label>Fecha de inicio:</label>
				                <input type="hidden" name="project_id" value="{{$project->id}}">
				                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">

					                <input type="text" name="start_date" id="start_date" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
					                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
					                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
					                </div>
					            </div>
				            </div>
			                  
			            </div><!-- /.card-body -->
			            

			            
				        <div class="card-footer" id="wizardProject">
				            <button type="submit" class="btn btn-primary">Guardar</button>
				            <button type="button" onclick="mostrarListado()" class="btn btn-default">Cancelar</button>
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

	$('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
		});
	
	function mostrarFormulario(){
		$('#deadlineListDiv').hide();
		$('#deadlineFormDiv').show('slow');
	}

	function mostrarListado(){
		$('#deadlineFormDiv').hide();
		$('#deadlineListDiv').show('slow');
	}



</script>

@endsection