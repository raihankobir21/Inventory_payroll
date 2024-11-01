@extends('layouts.app')

@section('content')
    <h1>Create Balance</h1>
    <form action="{{ route('company_remain_balances.store') }}" method="POST">
        @csrf
        <label for="event_table_name">Event Table Name:</label>
        <input type="text" name="event_table_name" id="event_table_name" value="{{ old('event_table_name') }}">

        <label for="event_table_row_id">Event Table Row ID:</label>
        <input type="text" name="event_table_row_id" id="event_table_row_id" value="{{ old('event_table_row_id') }}">

        <label for="amount">Amount:</label>
        <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}">

        <label for="created_user_id">Created User ID:</label>
        <input type="number" name="created_user_id" id="created_user_id" value="{{ old('created_user_id') }}">

        <label for="modified_user_id">Modified User ID:</label>
        <input type="number" name="modified_user_id" id="modified_user_id" value="{{ old('modified_user_id') }}">

        <label for="deleted_user_id">Deleted User ID:</label>
        <input type="number" name="deleted_user_id" id="deleted_user_id" value="{{ old('deleted_user_id') }}">

        <label for="status">Status:</label>
        <input type="radio" name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}> Active
        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}> Inactive

        <button type="submit">Submit</button>
    </form>
@endsection
