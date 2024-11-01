@extends('layouts.app')


@section('content')

      <div class="container justify-content-center">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Salary Category List</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('users.create') }}" class="btn btn-info float-sm-right"><i class="fas fa-plus-circle"></i> Add New Employee</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
              <div class="table-responsive">
             
                <table id="example1" class="table table-bordered table-striped">
                  
                  <thead>

                         <tr>
                           <th>No</th>
                           <th>Title </th>
                           <th>Basic Working Hour</th>
                           <th>Calculation Process</th>
                         </tr>
                  </thead>

                  <tbody>
                         @foreach ($data as $key => $d)

                            <tr>

                              <td>{{ $key+1 }}</td>

                              <td>{{ !empty($d->title ) ? $d->title  : '' }}</td>
                              
							
                              <td>{{ $d->basic_working_hour_start }} - {{ $d->basic_working_hour_end }}</td>

                              <td>{{ $d->calculation_process }}</td>


                            </tr>

                           @endforeach

                  </tbody>
                  
                  
                </table>

                 
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

