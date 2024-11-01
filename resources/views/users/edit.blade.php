@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Edit Employee </h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('users.index') }}" class="btn btn-info float-sm-right">
                                <i class="fas fa-angle-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')

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
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" class="form-control {{ $name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" class="form-control {{ $email }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Password" class="form-control {{ $password }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                                </div>
                            </div>

                            <!-- Role Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <select name="roles" class="form-control select2 {{ $role }}" data-placeholder="Select Role" style="width: 100%">
                                        <option value="">Select One</option> 
                                        @foreach ($roles as $key => $value)
                                            <option value="{{ $key }}" {{ in_array($key, $userRole) ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Staff ID Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff ID <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" name="staff_id" value="{{ old('staff_id', $user->staff_id) }}" class="form-control">
                                    @error('staff_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Mobile No. <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}">
                                    @error('mobile_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                           </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender <span class="man-remark" style="color:red;font-size:12px">*</span></label>
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

                            <!-- User Details from UserDetail Model -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" name="designation" value="{{ old('designation', !empty($user->userDetails->designation) ? $user->userDetails->designation : '') }}" class="form-control">
                                    @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- NID File Input -->
							
							 <div class="col-md-6">
                                <div class="form-group">
                                    <label>Photo <span class="highlight">( Type: jpeg, jpg, png. Max size= 512 KB)</span> <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="file" name="photo" class="form-control">
                                    @if( !empty($user->userDetails->photo) )
                                        <a href="{{ asset('storage/app/public/employees/' . !empty($user->userDetails->photo) ? $user->userDetails->photo : '') }}" target="_blank">View Current Photo</a>
                                    @endif
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
							
							
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NID <span class="highlight">( Type: jpeg, jpg, png, PDF. Max size= 1024 KB)</span> <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="file" name="nid" class="form-control">
                                    @if( !empty($user->userDetails->nid) )
                                        <a href="{{ asset('storage/app/public/employees/' . $user->userDetails->nid) }}" target="_blank">View Current NID</a>
                                    @endif
                                    @error('nid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Photo File Input -->
                           

                            <!-- Joining Date Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Joining Date <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="date" name="joining_date" value="{{ old('joining_date', !empty($user->userDetails->joining_date) ? $user->userDetails->joining_date : '') }}" class="form-control">
                                    @error('joining_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Present Address Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Present Address <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <textarea name="present_address" class="form-control">{{ old('present_address', !empty($user->userDetails->present_address) ? $user->userDetails->present_address : '') }}</textarea>
                                    @error('present_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Permanent Address Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Permanent Address <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <textarea name="permanent_address" class="form-control">{{ old('permanent_address', !empty($user->userDetails->permanent_address) ? $user->userDetails->permanent_address : '') }}</textarea>
                                    @error('permanent_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Emergency Contact Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Emergency Contact <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact', !empty($user->userDetails->emergency_contact) ? $user->userDetails->emergency_contact : '') }}" class="form-control">
                                    @error('emergency_contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Blood Group Field -->
                           
						    <div class="col-md-6">
                                <div class="form-group">
                                        <label for="blood_group">Blood Group <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                        <select name="blood_group" id="blood_group" class="form-control">
                                            <option value="">Select Blood Group</option>
											@php
												$oldBG = !empty($user->userDetails->blood_group) ? $user->userDetails->blood_group : 0;
											@endphp
                                            @foreach($bloodGroups as $bGroup)
                                                <option value="{{ $bGroup->id }}" {{ $oldBG == $bGroup->id ? 'selected' : '' }}>
                                                    {{ $bGroup->name }}
                                                </option>
                                            @endforeach
                                        </select>
									@error('blood_group')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                           </div>

                            <!-- Joining Salary Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Joining Salary <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                    <input type="text" name="joining_salary" value="{{ old('joining_salary', !empty($user->userDetails->joining_salary) ?  $user->userDetails->joining_salary : '') }}" class="form-control">
                                    @error('joining_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Salary Category <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                        <select class="form-control" id="title" name="salary_category">
                                            <option value="">Select Salary Category</option>
											@php
												$sCat = !empty($user->userDetails->salary_category_id) ? $user->userDetails->salary_category_id : 0;
											@endphp
											 @foreach($salaryCategories as $salaryCategory)
												
                                                <option value="{{ $salaryCategory->id }}" {{  $sCat == $salaryCategory->id ? 'selected' : '' }}>
                                                    {{ $salaryCategory->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('salary_category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            <!-- Employee Account Details -->
							<div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" value="{{ old('account_number', !empty($user->employeeAccount->account_number) ? $user->employeeAccount->account_number : '') }}" class="form-control">
                                    @error('account_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bank_name" class="form-label">Bank Name <span class="man-remark" style="color:red;font-size:12px">*</span></label>
                                        <select class="form-control" id="bank_name" name="bank_name">
                                            <option value="">Select Bank Name</option>
                                            @php
												$bName = !empty($user->employeeAccount->bank_id) ? $user->employeeAccount->bank_id : 0;
											@endphp
											@foreach($banks as $bank)
                                                <option value="{{ $bank->id }}" {{ $bName == $bank->id ? 'selected' : '' }}>
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
                                    <label>Account Name</label>
                                    <input type="text" name="account_name" value="{{ old('account_name', !empty($user->employeeAccount->account_name)  ? $user->employeeAccount->account_name : '') }}" class="form-control">
                                    @error('account_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Branch Name</label>
                                    <input type="text" name="branch_name" value="{{ old('branch_name', !empty($user->employeeAccount->branch_name) ? $user->employeeAccount->branch_name : '') }}" class="form-control">
                                    @error('branch_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 


                        </div>

                         
                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

@endsection
