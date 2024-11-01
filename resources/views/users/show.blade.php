@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Employee Details</h4>
                        </div>
                        <div class="col-sm-6 float-sm-right">
                            <a href="{{ route('users.index') }}" class="btn btn-info float-sm-right">
                                <i class="fas fa-angle-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>

                            <th>Mobile</th>
                            <td>{{ $user->mobile_no }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>

                            <th>Staff ID</th>
                            <td>{{ $user->userDetails->staff_id }}</td>
                        </tr>

                        <tr>
                            <th>Roles</th>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>

                            <th>Status</th>
                            <td>
                                @if($user->status == 1)
                                    <label class="badge badge-success">Active</label>
                                @else
                                    <label class="badge badge-danger">Inactive</label>
                                @endif
                            </td>
                        </tr>

                        <!-- User Details from UserDetail Model -->
                        <tr>
                            <th>Designation</th>
                            <td>{{ $user->userDetails->designation ?? 'N/A' }}</td>

                            <th>Joing Date</th>
                            <td>{{ $user->userDetails->joining_date ?? 'N/A' }}</td>
                  
                        </tr>

                        <tr>
                            <th>Photo</th>
                            <td>
                                @if($user->userDetails->photo)
                                    <a href="{{ asset('storage/app/public/employees/' . $user->userDetails->photo) }}" target="_blank">View Photo</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <th>NID</th>
                            <td>
                                @if($user->userDetails->nid)
                                    <a href="{{ asset('storage/app/public/employees/' . $user->userDetails->nid) }}" target="_blank">View NID</a>
                                @else
                                    N/A
                                @endif
                            </td>

                            
                        </tr>
                        <tr>
                            <th>Blood Group</th>
                            <td>{{ $user->userDetails->blood_group ?? 'N/A' }}</td> 
                            
                            <th>Joining Salary</th>
                            <td>{{ $user->userDetails->joining_salary ?? 'N/A' }}</td> 
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td>{{ $user->employeeAccount->bank_name ?? 'N/A' }}</td>

                            <th>Branch</th>
                            <td>{{ $user->employeeAccount->branch_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Account Name</th>
                            <td>{{ $user->employeeAccount->account_name ?? 'N/A' }}</td>
                            
                            <th>Account Number</th>
                            <td>{{ $user->employeeAccount->account_number ?? 'N/A' }}</td>
                        </tr>

                        <!-- Add other fields as needed -->
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
