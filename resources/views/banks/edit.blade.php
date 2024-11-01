@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Bank</h2>

    <form action="{{ route('banks.update', $bank->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Bank Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $bank->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
