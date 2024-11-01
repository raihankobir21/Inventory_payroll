@extends('layouts.backend')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Role</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('roles') }}">Role</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
                    <h4>Edit Role</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('roles.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  

              {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

                    @php 
                        $name = '';
                        $email = '';
                        $password = '';
                        $role = '';
                      @endphp
                      @error('name')
                          @php $name = 'is-invalid'; @endphp
                      @enderror

                      @error('email')
                          @php $email = 'is-invalid'; @endphp
                      @enderror

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Name</label>
                            {!! Form::text('name', null, array('placeholder' => 'Name', 'class' => 'form-control '.$name)) !!}
                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>
                        

                        <div class="form-group  col-sm-12">
                            <label for="exampleInputPassword1">Permission</label>
                              @error('permission')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('permission') }}</strong>
                                </span>
                              @enderror
                              <br/>
                              <div class="row">


                                  @foreach($permission as $value)

                                      <div class="col-4">
                                    
                                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                        
                                        @if( $value->segment_start == 1)
                                            <span style="color:#017f01;font-weight: bold">{{ $value->name }} &nbsp;&nbsp;</span>
                                        @else
                                            {{ $value->name }}
                                        @endif

                                      </div>
                                  @endforeach
                              </div>
                                      
                        </div>

                  </div>
           
            <!-- /.row -->
                  <button type="submit" class="btn btn-info">Update</button>
               
                {!! Form::close() !!}
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

