@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Edit Advance Payment </h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('employee-advance-payments.index') }}" class="btn btn-info float-sm-right">
                                <i class="fas fa-angle-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('employee-advance-payments.update', $advancePayments->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                            <!-- Project Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="project">Project</label>
                                    <select name="project" id="project" class="form-control @error('project') is-invalid @enderror" required>
                                        <option value="">Select Project</option>
                                        @foreach ($reArrangeProject as $key => $value)
										
                                            <option value="{{ $key }}" {{ ($key == $advancePayments->project_id) ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Employee Name Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Employee Name</label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">Select Employee</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ ($user->id == $advancePayments->user_id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Purpose Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">Purpose</label>
                                    <input type="text" name="purpose" value="{{ $advancePayments->purpose }}" id="purpose" class="form-control @error('purpose') is-invalid @enderror" required>
                                    @error('purpose')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Amount Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" value="{{ $advancePayments->amount }}" id="amount" class="form-control @error('amount') is-invalid @enderror" required>
                                    @error('amount')
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
