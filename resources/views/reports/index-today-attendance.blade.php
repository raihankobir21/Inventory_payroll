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
                                <th>SNO</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Staff Id</th>
                                <th>Status</th>
                                <th>Exit Time</th>
                                <th>Payable Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach( $allUsers as $key => $d)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>
                                    @if(!empty($d->userDetails->photo))
                                        <img src="{{ asset('storage/app/public/employees/' . $d->userDetails->photo) }}"  style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i> 
                                    @endif
                                    </td>
                                    <td>{{ $d->staff_id }}</td>
                                    <td>

                                    @if($d->attendance->isNotEmpty())
                                      <span style="color:green; ">Present</span>  at <br>
                                     {{ date("d M Y h:i:s A", strtotime($d->attendance[0]['created_at'] )) }}
                                    @else
                                    <span style="color:red; ">Absent</span>
                                    @endif

                                    </td>

                                    <td>
										@if($d->attendance->isNotEmpty() && $d->attendance[0]->exit_time)

											{{ date("d M Y h:i:s A", strtotime($d->attendance[0]->exit_time)) }}

										@else
											---
										@endif

                                    </td>
									
									
									
									 <td>
										@if( !empty($d->attendance[0]->payable_salary) )

											{{ $d->attendance[0]->payable_salary }}

										@else
											---
										@endif

                                    </td>
									
									<td>
										@php 
											$id = !empty($d->attendance[0]->exit_time) ? $d->attendance[0]['id'] : 0;
										@endphp
										
										@if( !empty($id ) )
										  <a class="btn btn-success btn-sm" href="{{ route('attendances.edit',$id ) }}"  data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-edit"></i></a>
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
              