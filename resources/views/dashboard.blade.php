@extends('layouts.adminlte')

@section('content')



    

    <section class="content-header">
      <div class="container-fluid">

        <div class="row">
            
          <div class="col-md-6">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mis Proyectos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <a href="/project" class="btn btn-primary btn-block">Crear Proyecto</a><br />

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      
                      <th>Name</th>
                      <th>Progress</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($projects as $project)
                    <tr>
                      <td>
                        <p><a href="/project/{{$project->id}}">{{ $project->name }}</a></p>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-danger">55%</span><br />
                        <a href="/deadline/{{ $project->id }}"><span class="badge bg-warning"><i class="fas fa-project-diagram"></i></span></a>

                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->

            
            
          


        </div>


      </div>
    </section>


    

@endsection


