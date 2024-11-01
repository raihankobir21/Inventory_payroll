@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Add Projects</h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('projects.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @if(isset($project))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Company Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <select class="form-control @error('company') is-invalid @enderror" id="company" name="company">
                                        <option value="">Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ old('company', $project->company ?? '') == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Project Name Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Project Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project->name ?? '') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Description Field -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $project->description ?? '') }}</textarea>
                                    @error('description')
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
