@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Create Employee Advance Payment</h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('employee-advance-payments.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('employee-advance-payments.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Project Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="project">Project</label>
                                    <select name="project" id="project" class="form-control @error('project') is-invalid @enderror" required>
                                        <option value="">Select Project</option>
                                        @foreach ($reArrangeProject as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
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
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                    <input type="text" name="purpose" id="purpose" class="form-control @error('purpose') is-invalid @enderror" required>
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
                                    <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" required>
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
