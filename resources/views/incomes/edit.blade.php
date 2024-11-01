@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Income</h2>

    <form action="{{ route('incomes.update', $income->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" id="company_id" class="form-control" required>
                <option value="">Select a company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $income->company_id == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" step="0.01" class="form-control" value="{{ $income->amount }}" required>
        </div>
        <div class="form-group">
            <label for="remarks">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control">{{ $income->remarks }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Income</button>
    </form>
</div>
@endsection
