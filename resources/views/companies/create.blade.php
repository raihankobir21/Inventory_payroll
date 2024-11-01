
@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>{{ isset($company) ? 'Edit Company' : 'Add Company' }}</h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('companies.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @if(isset($company))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $company->name ?? '') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mobile No Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No</label>
                                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $company->mobile_no ?? '') }}">
                                    @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $company->email ?? '') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address', $company->address ?? '') }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Status Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="1" {{ old('status', $company->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $company->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
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
