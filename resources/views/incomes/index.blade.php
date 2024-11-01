@extends('layouts.app')

@section('content')

    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h4>Income List</h4>
                            </div>
                            <div class="col-sm-6 float-sm-right">
                                <a href="{{ route('incomes.create') }}" class="btn btn-info float-sm-right">
                                    <i class="fas fa-plus-circle"></i> Add New Income
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Company</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incomes as $index => $income)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $income->company->name }}</td>
                                            <td>{{ number_format($income->amount, 2) }}</td>
                                            <td>{{ $income->remarks }}</td>
                                            <td>{{ $income->count_status ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a href="{{ route('incomes.show', $income->id) }}" class="btn btn-info btn-sm">Show</a>
                                                <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <br/>
                            {!! $incomes->links("pagination::bootstrap-4") !!}
                        </div>
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
