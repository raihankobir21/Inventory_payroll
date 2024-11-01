@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table table-bordered">
                <tr>
                    <th>Project ID</th>
                    <td>
                        <input type="text" name="project_custom_id" class="form-control" value="{{ $project->project_custom_id }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>Project Name</th>
                    <td>
                        <input type="text" name="name" class="form-control" value="{{ $project->name }}">
                    </td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td>
                        <select name="company_id" class="form-control">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == $project->company_id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>
                        <textarea name="description" class="form-control">{{ $project->description }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <select name="status" class="form-control">
                            <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $project->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </td>
                </tr>
            </table>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
