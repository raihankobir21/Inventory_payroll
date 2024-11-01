
@extends('layouts.app')

@section('content')
<h2 style="margin-bottom: 20px;">Today's Expenses</h2>
    <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('employee_expenses.index') }}" class="btn btn-info float-sm-right"><i class="fa fa-angle-double-left"></i> Back</a>
                  </div>

<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <thead>
        <tr>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">User</th>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Staff ID</th>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Purpose</th>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Amount</th>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Remaining Balance</th>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f2f2f2;">Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($todayExpenses as $expense)
        <tr>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $expense->user->name }}</td>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $expense->staff_id }}</td>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $expense->purpose }}</td>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $expense->expense_amount }}</td>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $expense->remain_balance }}</td>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $expense->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

