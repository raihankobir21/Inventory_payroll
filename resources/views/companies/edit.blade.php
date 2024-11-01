@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>  Edit Company  </h1>

        <form action="{{ route('companies.update', $company->id)  }}" method="POST">
            @csrf
            @if(isset($company))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name ?? '') }}">
            </div>

            <div class="form-group">
                <label for="mobile_no">Mobile No</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $company->mobile_no ?? '') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $company->email ?? '') }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address">{{ old('address', $company->address ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" {{ old('status', $company->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $company->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary"> Update </button>
        </form>
    </div>
@endsection
