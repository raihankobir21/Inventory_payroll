@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $bank->name }}</h1>
        <table class="table table-bordered mt-3">
            <tr>
                <th>Name:</th>
                <td>{{ $bank->name }}</td>
            </tr>
        </table>
        <a href="{{ route('banks.index') }}" class="btn btn-primary mt-3">Back to Banks</a>
    </div>
@endsection
