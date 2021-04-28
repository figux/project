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
              		<li class="breadcrumb-item"><a href="/deadline/{{$project_id}}">Volver a planeación</a></li>
              		
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
	                	<h3 class="card-title">{{ $viewTitle }}</h3>
	              	</div>
	              	<!-- /.card-header -->
	             	
	             	<div class="card-body table-responsive p-0">


	             		<table class="table table-hover text-nowrap">
		                  <thead>
		                    <tr>
		                      <th>Task</th>
		                      <th>Duration</th>
		                      <th>Cost</th>
		                    </tr>
		                  </thead>
		                  <tbody>

	                	

		                @if(count($traces) > 0)
							@foreach($traces as $trace)

							<tr>
		                      <td>{{$trace['task']}}</td>


		                      <td>{{$trace['duration']}}%</td>
		                      <td>{{ number_format($trace['cost'], 0, ',', '.') }}</td>
		                      
		                    </tr>
			                    
							@endforeach
		                @endif

		                 </tbody>
                		</table>
		                    
	                      
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