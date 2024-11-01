@extends('layouts.backend')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>User</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('roles') }}">Role</a></li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Role Details</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('roles.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                    <table  class="table table-bordered table-striped table-hover">
                        <tr>
                           <th>Name</th>
                           <td>{{ $role->name }}</td>
                        </tr>

                        <tr>
                           <th>Roles</th>
                           <td>
                               @if(!empty($rolePermissions))

                                  @foreach($rolePermissions as $v)

                                      {{ $v->name }},

                                  @endforeach

                              @endif
                           </td>
                    </table>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

 @endsection

