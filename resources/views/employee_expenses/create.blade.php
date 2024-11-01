@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Create Employee Expense</h4>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('employee_expenses.index') }}" class="btn btn-info"><i class="fas fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('employee_expenses.store') }}" method="POST">
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

                            <!-- Employee Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Employee</label>
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

                            <!-- Expense Amount Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expense_amount">Expense Amount</label>
                                    <input type="number" name="expense_amount" id="expense_amount" class="form-control @error('expense_amount') is-invalid @enderror" required>
                                    @error('expense_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Remarks Field -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="3"></textarea>
                                    @error('remarks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
