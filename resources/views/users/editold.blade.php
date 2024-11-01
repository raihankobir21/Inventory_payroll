@extends('layouts.app')


@section('content')

<div class="container justify-content-center">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Edit User</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('users.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  

              {{--{!! Form::model($user, ['method' => 'PATCH', 'enctype'  => 'multipart/form-data', 'route' => ['users.update', $user->id], 'autocomplete' => 'off' ]) !!}--}}

              <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
              @csrf
              @method('PATCH')

                    @php 
                        $name = '';
                        $email = '';
                        $password = '';
                        $role = '';
                        $image = '';
                      @endphp
                      @error('name')
                          @php $name = 'is-invalid'; @endphp
                      @enderror

                      @error('email')
                          @php $email = 'is-invalid'; @endphp
                      @enderror

                      @error('password')
                          @php $password = 'is-invalid'; @endphp
                      @enderror

                      @error('roles')
                          @php $role = 'is-invalid'; @endphp
                      @enderror

                      @error('image')
                          @php $image = 'is-invalid'; @endphp
                      @enderror

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Name</label>
                            {{--{!! Form::text('name', null, array('placeholder' => 'Name', 'class' => 'form-control '.$name)) !!}--}}
                            <input type="text" name="name" value="{{ $user->name }}" placeholder="Name" class="form-control" required>
                            @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Email</label>
                            {{-- {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control '.$email)) !!} --}}
                            <input type="email" name="email" placeholder="Enter email" class="form-control" value="{{ $user->email }}" required>

                            @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Password</label>
                             {{-- {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control '.$password)) !!}--}}
                            <input type="password" name="password" placeholder=" Password" class="form-control" value="" required>
                             @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Confirm Password</label>
                              {{--{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}--}}
                            <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control" required>
                          </div>
                          <!-- /.form-group -->
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Role</label>

                            {{--{!! Form::select('roles', $roles,$userRole, array('class' => 'select2 '.$role,  'data-placeholder' => 'Select Role', 'single' => 'single', 'style' => 'width: 100%')) !!}--}}
                            <select name="roles" class="select2 {{ $role }}" data-placeholder="Select Role" style="width: 100%" required>
                                <option value="" disabled>Select Role</option>
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" {{ $userRole == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            @error('roles')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('roles') }}</strong>
                                  </span>
                              @enderror

                          </div>
                        </div>

                        {{-- <div class="col-md-6">
                          <div class="form-group">
                                <label for="exampleInputEmail1">Profile Photo  </label>
                                <div>
                                   {!! Form::file('image', array('class' => 'form-control '.$image)) !!}
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <br/>
                                <img src="{{ asset('storage/app/public/users/'.$user->image) }}" width="80">

                          </div>

                          --}}
                        </div>

                  </div>
           
            <!-- /.row -->
                  <button type="submit" class="btn btn-info">Update</button>
               
                  {{-- {!! Form::close() !!} --}}
                 </form>
                 
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


 @endsection

