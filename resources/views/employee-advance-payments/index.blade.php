@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Employee Advance Payments</h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('employee-advance-payments.create') }}" class="btn btn-info float-sm-right">
                                <i class="fas fa-plus-circle"></i> Create New
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Project Name</th>
                                    <th>Employee Name</th>
                                    <th>Total Advance Amount</th>
                                    <th>Total Expense</th>
                                    <th>Remaining Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $balance)
                                    <tr>
                                        <td>{{ ($advancePayments->currentPage() - 1) * $advancePayments->perPage() + $key + 1 }}</td>
                                        <td>{{ $balance['project_name'] }}</td>
                                        <td>{{ $balance['user_name'] }}</td>
                                        <td>{{ number_format($balance['total_advance_amount'], 2) }}</td>
                                        <td>{{ number_format($balance['total_expense_amount'], 2) }}</td>
                                        <td>{{ number_format($balance['remaining_balance'], 2) }}</td>
                                        <td>
                                            <a href="{{ route('employee-advance-payments.showByUser', $balance['user_id']) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            {{-- Uncomment these if needed --}}
                                            {{--<a href="{{ route('employee-advance-payments.editByUser', $balance['user_id']) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('employee-advance-payments.destroyByUser', $balance['user_id']) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br/>
                        <!-- Add pagination links here -->
                        <div class="pagination justify-content-center">
                            {!! $advancePayments->links() !!}
                        </div>
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
