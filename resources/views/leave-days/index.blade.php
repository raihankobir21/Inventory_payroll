@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Leave Records</h4>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a href="{{ route('leave-days.create') }}" class="btn btn-info">
                                <i class="fas fa-plus-circle"></i> Create New Leave
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
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
                                    <th>User</th>
                                    <th>Month/Year</th>
                                    <th>Leave Days</th>
                                    <th>Total Present Days</th>  
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $key => $leave)
                                    <tr>
                                        <td>{{ $key + 1 + ($leaves->currentPage() - 1) * $leaves->perPage() }}</td> 
                                        <td>{{ $leave->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->month_year)->format('F Y') }}</td>
                                        
                                        <td>
                                            @php
                                                $leaveDays = json_decode($leave->leave_days);
                                            @endphp
                                            @if ($leaveDays)
                                                <ul>
                                                    @foreach ($leaveDays as $day)
                                                        <li>{{ \Carbon\Carbon::parse($day)->format('d F Y') }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>{{ $leave->total_days }}</td>
                                        <td>
                                            <a href="{{ route('leave-days.show', $leave->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('leave-days.edit', $leave->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('leave-days.destroy', $leave->id) }}" method="POST" style="display:inline-block;">
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

                        <!-- Pagination Links -->
                        <br/>
                        <div class="pagination justify-content-center">
                            {!! $leaves->links("pagination::bootstrap-4") !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
