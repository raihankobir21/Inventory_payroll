@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Employee Expenses Summary</h4>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a href="{{ route('employee_expenses.create') }}" class="btn btn-info">
                                <i class="fas fa-plus-circle"></i> Add New Expense
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
                                    <th>Project Name</th>
                                    <th>Employee Name</th>
                                    <th>Staff ID</th>
                                    <th>Purpose</th>
                                    <th>Previous in Hand</th>
                                    <th>Expense Amount</th>
                                    <th>Remaining Balance</th>
                                    <th>Remarks</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $key => $expense)
                                    <tr>
                                        <td>{{ $key + 1 + ($expenses->currentPage() - 1) * $expenses->perPage() }}</td> <!-- For pagination numbering -->
                                        <td>{{ $expense->project ? $expense->project->name : 'No Project' }}</td>
                                        <td>{{ $expense->user ? $expense->user->name : 'No Employee' }}</td>
                                        <td>{{ $expense->staff_id }}</td>
                                        <td>{{ $expense->purpose }}</td>
                                        <td>{{ number_format($expense->previous_in_hand, 2) }}</td>
                                        <td>{{ number_format($expense->expense_amount, 2) }}</td>
                                        <td>{{ number_format($expense->remain_balance, 2) }}</td>
                                        <td>{{ $expense->remarks }}</td>
                                        <td>{{ $expense->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('employee_expenses.show', $expense->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('employee_expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- Uncomment to enable delete functionality
                                            <form action="{{ route('employee_expenses.destroy', $expense->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <br/>
                        <div class="pagination justify-content-center">
                            {!! $expenses->links("pagination::bootstrap-4") !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
