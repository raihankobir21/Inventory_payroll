 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Employee Advance Payments for User ID: {{ $advancePayments->first()->user->name }}</h4>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Purpose</th>
                                <th>Amount</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advancePayments as $index => $payment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $payment->purpose }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('employee-advance-payments.edit', $payment->id) }}" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('employee-advance-payments.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

