@extends('layouts.app')

@section('content')
    <h1>Balance Details</h1>
    <p><strong>Event Table Name:</strong> {{ $companyRemainBalance->event_table_name }}</p>
    <p><strong>Event Table Row ID:</strong> {{ $companyRemainBalance->event_table_row_id }}</p>
    <p><strong>Amount:</strong> {{ $companyRemainBalance->amount }}</p>
    <p><strong>Status:</strong> {{ $companyRemainBalance->status ? 'Active' : 'Inactive' }}</p>
    <p><strong>Created User ID:</strong> {{ $companyRemainBalance->created_user_id }}</p>
    <p><strong>Modified User ID:</strong> {{ $companyRemainBalance->modified_user_id }}</p>
    <p><strong>Deleted User ID:</strong> {{ $companyRemainBalance->deleted_user_id }}</p>

    <a href="{{ route('company_remain_balances.index') }}">Back to list</a>
    <a href="{{ route('company_remain_balances.edit', $companyRemainBalance->id) }}">Edit</a>
    <form action="{{ route('company_remain_balances.destroy', $companyRemainBalance->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
