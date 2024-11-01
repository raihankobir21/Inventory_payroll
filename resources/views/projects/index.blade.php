@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Projects</h4>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a href="{{ route('projects.create') }}" class="btn btn-info">
                                <i class="fas fa-plus-circle"></i> Add New Project
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Project ID</th>
                                    <th>Project Name</th>
                                    <th>Company</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $key => $project)
                                    <tr>
                                        <td>{{ $key + 1 + ($projects->currentPage() - 1) * $projects->perPage() }}</td>
                                        <td>{{ $project->project_custom_id }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ !empty($project->company->name) ? $project->company->name : 'No Company' }}</td>
                                        <td>{{ $project->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')" data-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <br/>
                        <div class="pagination justify-content-center">
                            {!! $projects->links("pagination::bootstrap-4") !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
