@extends('layouts.app')


@section('content')

<div class="container justify-content-center">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Add Employee</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('users.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  

              {{-- {!! Form::open(array('route' => 'users.store','method'=>'POST', 'enctype'  => 'multipart/form-data', 'autocomplete' => 'off' )) !!}--}}
                    
              <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
              @csrf

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

                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control">

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
                            {{--{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control '.$email)) !!}--}}
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control ">

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
                            <label>Role</label>

                            
                            <select name="roles[]" class="form-control select2 {{ $role }}" data-placeholder="Select Role" style="width: 100%">
                                <option value="">Select Role</option>
                                           
								@foreach ($roles as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>

                            @error('roles')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('roles') }}</strong>
                                  </span>
                              @enderror

                          </div>
                        </div>
                        
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label"> Staff ID  <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" class="form-control" id="staff_id" name="staff_id" value="{{ old('staff_id') }}">
                                    @error('staff_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                           </div>

                          

                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label"> Mobile No.  <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}">
                                    @error('mobile_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                           </div>

                           <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender:</label>
                                    <div>
                                        <label><input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male</label>
                                        <label><input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female</label>
                                        <label><input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}> Other</label>
                                        @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                           </div>

                           <div class="col-md-6">
                                <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <select name="blood_group" id="blood_group" class="form-control">
                                            <option value="">Select Blood Group</option>
                                            @foreach($bloodGroups as $bGroup)
                                                <option value="{{ $bGroup->id }}" {{ old('blood_group') == $bGroup->id ? 'selected' : '' }}>
                                                    {{ $bGroup->name }}
                                                </option>
                                            @endforeach
                                        </select>
									@error('blood_group')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                           </div>
                           

                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label"> Designation  <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}">
                                    @error('designation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            
                                
                            
                                <div class="col-md-6">
									<div class="form-group">
										<label for="" class="form-label"> Photo <span class="man-reamark" style="color:red;font-size:12px">*</span> <span class="highlight">( Type: jpeg, jpg, png. Max size= 512 KB)</span></label>
										<input type="file" class="form-control" id="photo" name="photo" value="{{ old('photo') }}">
										@error('photo')
											<div class="text-danger">{{ $message }}</div>
										@enderror
									</div>
                                </div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="" class="form-label"> NID file  <span class="man-reamark" style="color:red;font-size:12px">*</span> <span class="highlight">( Type: jpeg, jpg, png, PDF. Max size= 1024 KB)</span></label>
										<input type="file" class="form-control" id="nid" name="nid" value="{{ old('nid') }}">
										@error('nid')
											<div class="text-danger">{{ $message }}</div>
										@enderror
									</div>
                                </div>
                            
                                <div class="col-md-6">
									<div class="form-group">
										<label for="" class="form-label"> Joining Date <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
										<input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ old('joining_date') }}">
										@error('joining_date')
											<div class="text-danger">{{ $message }}</div>
										@enderror
									</div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Present Address <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                        <textarea class="form-control" id="present_address" name="present_address">{{ old('present_address') }}</textarea>
                                        @error('present_address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Permanent Address <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                        <textarea class="form-control" id="permanent_address" name="permanent_address">{{ old('permanent_address') }}</textarea>
                                        @error('permanent_address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Emergency Contact <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                        <textarea class="form-control" id="emergency_contact" name="emergency_contact">{{ old('emergency_contact') }}</textarea>
                                        @error('emergency_contact')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Salary Category <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                        <select class="form-control" id="" name="salary_category">
                                            <option value="">Select Salary Category</option>
                                            @foreach($salaryCategories as $salaryCategory)
                                                <option value="{{ $salaryCategory->id }}" {{ old('salary_category') == $salaryCategory->id ? 'selected' : '' }}>
                                                    {{ $salaryCategory->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('salary_category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
								
								
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Joining Salary <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                        <input type="text" class="form-control" id="joining_salary" name="joining_salary" value="{{ old('joining_salary') }}">
                                        @error('joining_salary')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                               


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bank_name" class="form-label">Bank Name <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                        <select class="form-control" id="bank_name" name="bank_name">
                                            <option value="">Select Bank Name</option>
                                            @foreach($banks as $bank)
                                                <option value="{{ $bank->id }}" {{ old('bank_name') == $bank->id ? 'selected' : '' }}>
                                                    {{ $bank->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bank_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Branch </label>
                                        <input type="text" class="form-control" id="branch_name" name="branch_name" value="{{ old('branch_name') }}">
                                        @error('branch_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Account Name </label>
                                        <input type="text" class="form-control" id="account_name" name="account_name" value="{{ old('account_name') }}">
                                        @error('account_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Account Number <span class="man-reamark" style="color:red;font-size:12px">*</span></label>
                                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number') }}">
                                        @error('account_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                        

                          {{-- <div class="col-md-6">
                          <div class="form-group">
                            <label>Branch</label>

                            {!! Form::select('branch_id', $branches,[], array('class' => 'select2 '.$role,  'data-placeholder' => 'Select Branch', ' single' => 'single', 'style' => 'width: 100%')) !!}
                            @error('branch_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('branch_id') }}</strong>
                                  </span>
                              @enderror

                          </div>
                        </div>--}}

                        {{--<div class="col-md-6">
                          <div class="form-group">
                                <label for="exampleInputEmail1">Profile Photo  </label>
                                <div>
                                    {!! Form::file('image', array('class' => 'form-control '.$image)) !!}
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('flag') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                          </div>
                        </div>--}}

                  </div>
           
            <!-- /.row -->
                  <button type="submit" class="btn btn-info">Submit</button>
               
                {{--{!! Form::close() !!}--}}
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

