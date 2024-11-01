@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Project Details</h1>

        <table class="table table-bordered">
            <tr>
                <th>Project ID</th>
                <td>{{ $project->project_custom_id }}</td>
            </tr>
            <tr>
                <th>Project Name</th>
                <td>{{ $project->name }}</td>
            </tr>
            <tr>
                <th>Company</th>
                <td>{{ $project->company->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $project->description }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $project->status == 1 ? 'Active' : 'Inactive' }}</td>
            </tr>
        </table>

        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit Project</a>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
    </div>
@endsection
