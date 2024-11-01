@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Capital Record Details</h1>

    <table class="table table-bordered">
        <tr>
            <th>Amount</th>
            <td>{{ number_format($capital->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Expense</th>
            <td>{{ number_format($capital->expense, 2) }}</td>
        </tr>
        <tr>
            <th>Remain Balance</th>
            <td>{{ number_format($capital->remain_balance, 2) }}</td>
        </tr>
        <tr>
            <th>Purpose</th>
            <td>{{ $capital->purpose }}</td>
        </tr>
        <tr>
            <th>Created By</th>
            <td>{{ $capital->created_user_id }}</td>
        </tr>
        <tr>
            <th>Modified By</th>
            <td>{{ $capital->modified_user_id }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $capital->count_status == 1 ? 'Active' : 'Inactive' }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $capital->created_at->format('d M Y, h:i A') }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $capital->updated_at->format('d M Y, h:i A') }}</td>
        </tr>
    </table>

    <a href="{{ route('capitals.index') }}" class="btn btn-primary">Back to List</a>
    <a href="{{ route('capitals.edit', $capital->id) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('capitals.destroy', $capital->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
