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
              		<li class="breadcrumb-item"><a href="/deadline/{{$project_id}}">Volver a Planeación</a></li>
              		
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
	                	<h3 class="card-title">Seguimientos</h3>
	              	</div>
	              	<!-- /.card-header -->
	             	
	             	<div class="card-body">

	                	

		                @if(count($traces) > 0)
							@foreach($traces as $trace)

								<h3>{{$trace['task']}}</h3>
                      			
                      			<div class="progress-group">
				                    <span class="progress-text">Duración estimada</span>
				                    <span class="float-right"><b>{{$trace['estimated_duration']}}%</b></span>
				                    <div class="progress progress-sm">
				                    	<div class="progress-bar bg-success" style="width: {{$trace['estimated_duration']}}%"></div>
				                    </div>
				                </div>
				                <div class="progress-group">
				                    <span class="progress-text">Costo estimado</span>
				                    <span class="float-right"><b>$ {{$trace['estimated_cost_value']}}</b></span>
				                    <div class="progress progress-sm">
				                    	<div class="progress-bar bg-success" style="width: {{$trace['estimated_cost']}}%"></div>
				                    </div>
				                </div>
				                <div class="progress-group">
				                    <span class="progress-text">Duración Real</span>
				                    <span class="float-right"><b>{{$trace['real_duration']}}%</b></span>
				                    <div class="progress progress-sm">
				                    	<div class="progress-bar bg-success" style="width: {{$trace['real_duration']}}%"></div>
				                    </div>
				                </div>
				                <div class="progress-group">
				                    <span class="progress-text">Costo Real</span>
				                    <span class="float-right"><b>{{$trace['real_cost']}}%</b></span>
				                    <div class="progress progress-sm">
				                    	<div class="progress-bar bg-success" style="width: {{$trace['real_cost']}}%"></div>
				                    </div>
				                </div>
				                
			                    
							@endforeach
		                @endif
		                    
	                      
	              	</div>
	              	<!-- /.card-body -->
	              
	            </div>
	            <!-- /.card -->

	            
	        </div><!-- /col-6 -->
	    </div>

    	


		
		

    </div>
</section>


@endsection

@section('scripts')
<script type="text/javascript">

	



</script>

@endsection