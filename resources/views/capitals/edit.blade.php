@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Capital Record</h1>

    <form action="{{ route('capitals.update', $capital->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" value="{{ $capital->amount }}">
        </div>
    
        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose</label>
            <input type="text" class="form-control" id="purpose" name="purpose" value="{{ $capital->purpose }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
