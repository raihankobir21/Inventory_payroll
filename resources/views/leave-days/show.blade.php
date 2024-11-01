<!-- @extends('layouts.app')

@section('content')
    <h1>Off Day Details</h1>
    <p><strong>Title:</strong> {{ $offDay->title }}</p>
    <p><strong>Month and Year:</strong> {{ \Carbon\Carbon::parse($offDay->month_year)->format('F Y') }}</p>
    <p><strong>Off Days:</strong> {{ implode(', ', json_decode($offDay->off_days)) }}</p>
    <p><strong>Total Days:</strong> {{ $offDay->total_days }}</p>
    <p><strong>Remaining Working Days:</strong> {{ $offDay->remain_working_days }}</p>
    <a href="{{ route('off-days.index') }}" class="btn btn-primary">Back to List</a>
@endsection -->
