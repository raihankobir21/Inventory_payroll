@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Monthly Salary Report</h1>

    <!-- Filter Form to Select Month and Year -->
    <form action="{{ route('reports.monthly_salary') }}" method="GET">
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="month" class="form-label">Select Month</label>
                <select name="month" id="month" class="form-select">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="year" class="form-label">Select Year</label>
                <select name="year" id="year" class="form-select">
                    @foreach(range(Carbon\Carbon::now()->year, 2000) as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Show the selected month and year -->
    @if(isset($startDate) && isset($endDate))
        <p><strong>Report for:</strong> {{ $startDate->format('F Y') }}</p>
    @endif

    <!-- Table to display the monthly salary details -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Staff ID</th>
                <th>Name</th>
                <th>Joining Salary</th>
                <th>Total Payable Salary</th>
                <th>Total Working Hours</th>
                <th>Attendance Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyReport as $report)
                <tr>
                    <td>{{ $report['staff_id'] }}</td>
                    <td>{{ $report['name'] }}</td>
                    <td>{{ number_format($report['joining_salary'], 2) }}</td>
                    <td>{{ number_format($report['total_payable_salary'], 2) }}</td>
                    <td>{{ $report['total_working_hours'] }}</td>
                    <td>{{ $report['attendance_count'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
