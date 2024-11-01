@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Income Details</h2>

    <p><strong>Company:</strong> {{ $income->company->name }}</p>
    <p><strong>Amount:</strong> {{ $income->amount }}</p>
    <p><strong>Remarks:</strong> {{ $income->remarks }}</p>
    <p><strong>Status:</strong> {{ $income->count_status ? 'Active' : 'Inactive' }}</p>

    <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Back to Incomes</a>
</div>
@endsection
