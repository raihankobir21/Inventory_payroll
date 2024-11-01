
@extends('layouts.app')

@section('content')
    <h2>Date-wise Expenses Report</h2>
        <div style="display: flex; justify-content: space-between; margin-top: 20px; margin-bottom: 20px;">
            <a href="{{ route('employee_expenses.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
            style="padding: 10px 15px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 5px;">
                Download PDF
            </a>
            <a href="{{ route('employee_expenses.index') }}" 
            style="padding: 10px 15px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">
                Back
            </a>
        </div>

    <form action="{{ route('employee_expenses.datewise') }}" method="GET" style="margin-bottom: 20px;">

        <div class="row">
            <div style="margin-bottom: 0px;">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" required>
            </div>
            <div style="margin-left: 20px; margin-bottom: 20px;">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" required>
            </div>
        </div>
        <button type="submit" style="padding: 5px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Search</button>
    </form>

    @if($expenses->isNotEmpty())
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">User</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Staff ID</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Purpose</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Amount</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Remaining Balance</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
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
    @else
        <p>No expenses found for the selected dates.</p>
    @endif
    @endsection

