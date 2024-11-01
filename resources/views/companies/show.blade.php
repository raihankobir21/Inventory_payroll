@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $company->name }}</h1>
        <a href="{{ route('companies.index') }}" class="btn btn-primary mt-3">Back</a>
        <table class="table table-bordered mt-3">
            <tr>
                <th>Mobile No:</th>
                <td>{{ $company->mobile_no }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $company->email }}</td>
            </tr>
            <tr>
                <th>Address:</th>
                <td>{{ $company->address }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>{{ $company->status == 1 ? 'Active' : 'Inactive' }}</td>
            </tr>
        </table>
        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
    </div>
@endsection
