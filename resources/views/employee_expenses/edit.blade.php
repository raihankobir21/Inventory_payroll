@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Employee Expense</h2>

    <form action="{{ route('employee_expenses.update', $expense->id) }}" method="POST">
        @csrf
        @method('PUT')
		
		<div class="form-group">
            <label for="user_id">Project</label>
            <select name="project" id="" class="form-control" required>
                <option value="">Select Project</option>
                @foreach ($reArrangeProject as $key=> $v)
                    <option value="{{ $key }}" {{ ($key == $expense->project_id) ? 'selected' : '' }}>{{ $v }}</option>
                @endforeach
            </select>
        </div>
		
		
        <div class="form-group">
            <label for="user_id">Employee</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $expense->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="staff_id">Staff ID</label>
            <input type="text" name="staff_id" id="staff_id" class="form-control" value="{{ $expense->staff_id }}">
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <input type="text" name="purpose" id="purpose" class="form-control" value="{{ $expense->purpose }}">
        </div>

        <div class="form-group">
            <label for="expense_amount">Expense Amount</label>
            <input type="number" name="expense_amount" id="expense_amount" class="form-control" value="{{ $expense->expense_amount }}">
        </div>

        <div class="form-group">
            <label for="remain_balance">Remaining Balance</label>
            <input type="number" name="remain_balance" id="remain_balance" class="form-control" value="{{ $remainBalance }}" readonly>
        </div>
        <div class="form-group">
            <label for="remarks">Remarks</label>
            <input type="text" name="remarks" id="remarks" class="form-control" value="{{ $expense->remarks }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
