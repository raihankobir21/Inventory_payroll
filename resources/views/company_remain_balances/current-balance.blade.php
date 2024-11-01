@extends('layouts.app')


@section('content')

      <div class="container justify-content-center">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4> Remain Balance</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                       
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
              <div class="table-responsive">
             
                <table id="example1" class="table table-bordered table-striped">
                  
                  <thead>

                         <tr>
							<th style="font-size:24px; text-align: center">Tk. {{ $checkCurrentBaqlance }} </th>
                         </tr>
                  </thead>

                 
                  
                  
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

