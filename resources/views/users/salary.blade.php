@extends('layouts.app')


@section('content')

      <div class="container justify-content-center">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Current Salary</h4>
                  </div>
                  <!-- <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('users.create') }}" class="btn btn-info float-sm-right"><i class="fas fa-plus-circle"></i> Add New Employee</a>
                  </div> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
              <div class="table-responsive">
             
                <table id="example1" class="table table-bordered table-striped">
                  
                  <thead>

                         <tr>
                           <th>No</th>
                           <th>Employee ID </th>
                           <th>Name</th>
                           <th>Photo</th>
                           <th>Salary Category</th>
                           <th>Current Payable</th>
                           <th>Roles</th>
                           {{--<th width="280px">Action</th> --}}
                           <th>Action</th>
                         </tr>
                  </thead>

                  <tbody>
                         @foreach ($data as $key => $d)
							 <tr>

                              <td>{{ ++$i }}</td>

                              <td>{{ !empty($d->staff_id) ? $d->staff_id : '' }}</td>
                              
							
							  
                              <td>{{ $d->name }}</td>
                              <td>
									@if(!empty($d->userDetails->photo))
                                        <img src="{{ asset('storage/app/public/employees/' . $d->userDetails->photo) }}"  style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i> 
                                    @endif
							  </td>
                             
							 <td>{{ !empty( $d->userDetails->salary_category_id) ? $salaryCategories[$d->userDetails->salary_category_id] : '' }}</td>
                             
							 {{-- <td>{{ !empty( $d->userDetails->joining_salary) ? $d->userDetails->joining_salary : '' }}</td> --}}

								<td>
									@if(!empty($d->attendance))
										@php 
											$payable = 0;
										@endphp
										
										@foreach($d->attendance as $amt )
												@php $payable += $amt['payable_salary'] @endphp
										@endforeach
										{{ number_format($payable ,2) }}
									@endif
								</td>
                              <td>

                                @if(!empty($d->getRoleNames()))

                                  @foreach($d->getRoleNames() as $v)

                                     <label class="badge badge-success">{{ $v }}</label>

                                  @endforeach

                                @endif

                              </td>

                              

                              {{--<td>
                                        @can('country-list')
                                          <a class="btn btn-primary btn-sm" href="{{ route('users.show',$d->id) }}"  data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-eye"></i></a>
                                        @endcan
                                        
                                        @can('country-active-inactive')
                                          @if($d->status == 1)
                                              <a class="btn btn-danger btn-sm show-modal" href="#" data-toggle="tooltip" data-placement="top" title="Inactive" value-id="{{$d->id}}" value-title="Inactive" message= "Are you sure? You want to inactive ?" method="get" action="users-active-inactive" ><i class="fa fa-times" aria-hidden="true"></i></a>
                                          @else   
                                              <a class="btn btn-success btn-sm show-modal" href="#" data-toggle="tooltip" data-placement="top" title="Active" value-id="{{$d->id}}" value-title="Active"  message="Are you sure? You want to active ?" method="get" action="users-active-inactive"><i class="fa fa-check-circle" aria-hidden="true"></i></a>

                                          @endif
                                        @endcan

                                        @can('user-employee-edit')
                                          <a class="btn btn-success btn-sm" href="{{ route('users.edit',$d->id) }}"  data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-edit"></i></a>
                                        @endcan

                                      </form>

                                </td> --}}

                               <td>
                                    
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.show', $d->id) }}" data-toggle="tooltip" data-placement="left" title="Show">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                     
                               </td>

                            </tr>

                           @endforeach

                  </tbody>
                  
                  
                </table>

                  <br/>
                  {!! $data->links("pagination::bootstrap-4") !!}

              </div>
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

