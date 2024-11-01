@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Companies</h4>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a href="{{ route('companies.create') }}" class="btn btn-info">
                                <i class="fas fa-plus-circle"></i> Add New Company
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
                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $key => $company)
                                    <tr>
                                        <td>{{ $key + 1 + ($companies->currentPage() - 1) * $companies->perPage() }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->mobile_no }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?')" data-toggle="tooltip" title="Delete">
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
                            {!! $companies->links("pagination::bootstrap-4") !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
