@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Edit Attendances </h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ URL::previous() }}" class="btn btn-info float-sm-right">
                                <i class="fas fa-angle-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('attendances.update', $data->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')

                        @php 
                            $name = '';
                            $email = '';
                            $password = '';
                            $role = '';
                            $image = '';
                            $remarks = '';
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

                        @error('remarks')
                            @php $remarks = 'is-invalid'; @endphp
                        @enderror

                        <div class="row">
                           
                            <!-- Staff ID Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff ID</label>
                                    <input type="text" name="" value="{{ old('staff_id', $data->staff_id) }}" class="form-control" disabled>
                                    @error('staff_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
							
							<div class="col-md-6">
                                <div class="form-group">
                                    <label>In Time</label>
                                    <input type="text" name="" value=" {{ date("d M Y h:i:s a", strtotime($data->created_at )) }}" class="form-control" disabled>
                                    @error('staff_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
							
							<div class="col-md-6">
                                <div class="form-group">
                                    <label>Exit Time</label>
                                    <input type="text" name="" value=" {{ date("d M Y h:i:s a", strtotime($data->exit_time )) }}" class="form-control" disabled>
                                    @error('staff_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
							
							 <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payable Amount</label>
                                    <input type="text" name="payable_salary" value="{{ old('name', $data->payable_salary) }}" placeholder="Enter payable amount" class="form-control {{ $name }}">
                                    @error('payable_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                           <div class="col-md-6">
                                <div class="form-group">
                                    <label>Late Considerable</label>
                                    <div>
                                        <label><input type="checkbox" name="late_consider" value="1" {{ ($data->late_consider == 1) ? 'checked' : '' }}> Yes</label>
                                        @error('late_consider')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                           </div>


                           <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input type="text" name="remarks" value="{{ old('name', $data->remarks) }}" placeholder="Enter remarks" class="form-control {{ $remarks }}">
                                    @error('remarks')
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
