@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4> Attendance Reports Today</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('home') }}" class="btn btn-info float-sm-right"><i class="fa fa-angle-double-left"></i> Back</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
               

              <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SlNO</th>
                                <th>Employee Name</th>
                                <th>Employee photo</th>
                                <th>Employee Id</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach( $allEmployees as $key => $d)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>
                                    @if(!empty($d->employeeDetails->photo))
                                        <img src="{{ asset('storage/app/public/employee/' . $d->employeeDetails->photo) }}" alt="Employee Photo" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i> 
                                    @endif
                                    </td>
                                    <td>{{ $d->staff_id }}</td>
                                    <td>

                                    @if($d->attendance->isNotEmpty())
                                      <span style="color:green; ">Present</span>  at <br>
                                     {{ date("d-m-Y h:i:s a", strtotime($d->attendance[0]['created_at'] )) }}
                                    @else
                                    <span style="color:red; ">Absent</span>
                                    @endif

                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
              



              </div>
              </div>
        </div>
    </div>
</div>
@endsection
              