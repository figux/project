@extends('layouts.adminlte')

@section('content')
    

    <section class="content-header">
      <div class="container-fluid">

        <div class="row">
            
          <div class="col-md-6">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mis Usuarios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <a href="/project" class="btn btn-primary btn-block">Crear Usuario</a><br />

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      
                      <th>Name</th>
                      <th>Rol</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>
                        <p><a href="/project/{{$project->id}}">{{ $user->name }}</a></p>
                      </td>
                      <td>

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


