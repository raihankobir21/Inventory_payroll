@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Expense Details</h2>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $expense->id }}</td>
        </tr>
        <tr>
            <th>Employee ID</th>
            <td>{{ $expense->user_id }}</td>
        </tr>
        <tr>
            <th>Staff ID</th>
            <td>{{ $expense->staff_id }}</td>
        </tr>
        <tr>
            <th>Purpose</th>
            <td>{{ $expense->purpose }}</td>
        </tr>
        <tr>
            <th>Expense Amount</th>
            <td>{{ $expense->expense_amount }}</td>
        </tr>
        <tr>
            <th>Remaining Balance</th>
            <td>{{ $expense->remain_balance }}</td>
        </tr>
    </table>

    <a href="{{ route('employee_expenses.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
