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
							{{-- <a class="btn btn-danger" href="{{ route('attendance-report.pdf') }}">Download PDF</a> --}}

                  </div>
                </div>
              </div>
              <div class="table-responsive">
               
              <div class="card-body">
                
              <a class="btn btn-warning" href="{{ route('export') }}">Export with Excel</a><br>

              <form method="POST" action="{{ route('date-wise-attendance-report-search') }}" enctype= multipart/form-data>
              @csrf

              <div class="row">

              <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="" placeholder="Date" required>
                        @error('from_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
              </div>
              

              <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="" placeholder="Date" required>
                        @error('to_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
              </div>
        

              <div class="col-md-6">
                <div class="form-group">
                   <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>

              </div>

              </form>

              <div class="table-responsive">
              @if(!empty($dailyRecords))
                        @foreach($dailyRecords as $date => $records)
                            <h5>Attendance for <span style="font-weight:bold;"> ( {{ $date }} ) </span></h5>
                            @if(!empty($records))
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                              
													<th>SNO</th>
													<th>Name</th>
													<th>Staff Id</th>
													<th>Photo</th>
													<th>Status</th>
													<th>Exit Time</th>
													<th>Payable Salary</th>
													<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($records as $key => $user)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $user['name'] }}</td>
                                                    <td>{{ $user['staff_id'] }}</td>

                                                    <td>
                                                    @if(!empty( $user['user_details']['photo'] ))
                                                        <img src="{{ asset('storage/app/public/employees/' . $user['user_details']['photo']) }}"  style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i> 
                                                    @endif
                                                    </td>

                                                    <td>

                                                    @if( !empty($user['attendance']) )
                                                         <span style="color:#00cc00; font-weight:bold;">Present</span>  at <br>
                                                        {{ date("d-m-Y h:i:s a", strtotime($user['attendance'][0]['created_at'] )) }}

                                                    @else
                                                    <span style="color:red; font-weight:bold; ">Absent</span> 
                                                    @endif
                                                            
                                                    </td>
													
																	
                                                    <td>
                                                        @if(!empty($user['attendance']))
                                                            @if($user['attendance'][0]['exit_time'] == NULL)
                                                                ---
                                                            @else
                                                                {{ $user['attendance'][0]['exit_time'] }}
                                                            @endif
                                                        @else
                                                            ---
                                                        @endif
                                                        
                                                    </td>
													
													 <td>
                                                        @if(!empty($user['attendance']))
                                                            @if($user['attendance'][0]['payable_salary'] == NULL)
                                                                ---
                                                            @else
                                                                {{ $user['attendance'][0]['payable_salary'] }}
                                                            @endif
                                                        @else
                                                            ---
                                                        @endif
                                                        
                                                    </td>
													
													<td>
														@php 
															$id = !empty($user['attendance'][0]['exit_time']) ? $user['attendance'][0]['id'] : 0;
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
                            @else
                                <div style="color: red; font-weight: bold; font-size: 1.2em;">
                                    No records for this date.
                                </div>
                            @endif
                        @endforeach
                        <br>
                    @else
                        <div style="color: red; font-weight: bold; font-size: 1.2em;">
                            No records found
                        </div>
                    @endif

              </div>
              </div>
              </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {

    let minDate = '{{ $minAvailableDate }}';

    // alert(minDate);

    let maxDate = '{{ $maxAvailableDate }}';

    // alert(maxDate);
    
    let fromDateInput = document.getElementById('from_date');
    let toDateInput = document.getElementById('to_date');

    fromDateInput.setAttribute('min', minDate);
    fromDateInput.setAttribute('max', maxDate);

    toDateInput.setAttribute('min', minDate);
    toDateInput.setAttribute('max', maxDate);

    // fromDateInput.addEventListener('change', () => {
    //     let fromDate = new Date(fromDateInput.value);
    //     let toDate = new Date(toDateInput.value);

    //     if (toDate < fromDate) {
    //         toDateInput.value = fromDateInput.value;
    //     }

    //     toDateInput.setAttribute('min', fromDateInput.value);
    // });
});

</script>
@endsection
              