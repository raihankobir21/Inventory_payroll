@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Add Income</h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('incomes.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('incomes.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="row">
                            <!-- Company Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_id">Company</label>
                                    <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror" required>
                                        <option value="">Select a company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
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
                                    <input type="number" name="amount" id="amount" step="0.01" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                                    @error('amount')
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
                                    <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks') }}</textarea>
                                    @error('remarks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>
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
