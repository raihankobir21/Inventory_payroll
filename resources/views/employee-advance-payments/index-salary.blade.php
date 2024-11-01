@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Employee Advance Payments</h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('employee-advance-payments.create') }}" class="btn btn-info float-sm-right"><i class="fas fa-plus-circle"></i> Create New</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
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
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $balance['user_name'] }}</td>
                                    <td>{{ number_format($balance['total_advance_amount'], 2) }}</td>
                                    <td>{{ number_format($balance['total_expense_amount'], 2) }}</td>
                                    <td>{{ number_format($balance['remaining_balance'], 2) }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('employee-advance-payments.showByUser', $balance['user_id']) }}" data-toggle="tooltip" data-placement="left" title="Show"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-warning btn-sm" href="{{ route('employee-advance-payments.editByUser', $balance['user_id']) }}" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('employee-advance-payments.destroyByUser', $balance['user_id']) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" data-toggle="tooltip" data-placement="left" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
