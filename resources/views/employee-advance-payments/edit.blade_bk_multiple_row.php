@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Employee Advance Payments for User ID: {{ $advancePayments->first()->user->name }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('employee-advance-payments.updateByUser', $advancePayments->first()->user_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advancePayments as $index => $payment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <input type="text" name="payments[{{ $payment->id }}][purpose]" class="form-control" value="{{ $payment->purpose }}" required>
                                        </td>
                                        <td>
                                            <input type="number" name="payments[{{ $payment->id }}][amount]" class="form-control" value="{{ $payment->amount }}" required>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>

                    <a href="{{ route('employee-advance-payments.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
