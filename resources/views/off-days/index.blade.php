@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Off Days</h4>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a href="{{ route('off-days.create') }}" class="btn btn-info">
                                <i class="fas fa-plus-circle"></i> Create New Off Day
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Success message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Title</th>
                                    <th>Total Days</th>
                                    <th>Total Off</th>
                                    <th>Remaining Working Days</th>
                                    <th>Month/Year</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offDays as $key => $offDay)
                                    <tr>
                                        <td>{{ $key + 1 + ($offDays->currentPage() - 1) * $offDays->perPage() }}</td> <!-- Dynamic Sl No -->
                                        <td>{{ $offDay->title }}</td>
                                        <td>{{ $offDay->total_days }}</td>
                                        <td>{{ json_decode($offDay->off_days) ? count(json_decode($offDay->off_days)) : 0 }}</td> <!-- Total Off Days -->
                                        <td>{{ $offDay->remain_working_days }}</td>
                                        <td>{{ \Carbon\Carbon::parse($offDay->month_year)->format('F Y') }}</td>
                                        <td>
                                            <a href="{{ route('off-days.show', $offDay->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('off-days.edit', $offDay->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('off-days.destroy', $offDay->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <br/>
                    <div class="pagination justify-content-center">
                        {!! $offDays->links("pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
