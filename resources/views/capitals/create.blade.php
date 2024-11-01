@extends('layouts.app')


@section('content')

<div class="container justify-content-center">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Add Capital</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('capitals.index') }}" class="btn btn-info float-sm-right"><i class="fas fa-angle-left"></i> Back</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  

                     
              <form action="{{ route('capitals.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
              @csrf

                      @php 
                        $amount = '';
                        $remarks = '';
                      @endphp

                      @error('amount')
                          @php $amount = 'is-invalid'; @endphp
                      @enderror

                      @error('remarks')
                          @php $remarks = 'is-invalid'; @endphp
                      @enderror
                      

                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                               
                                <input type="text" class="form-control {{$amount}}" id="amount" name="amount" >
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" class="form-control  {{$remarks}}" id="remarks" name="remarks" >
                                @error('Remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        



                    

                  </div>
           
            <!-- /.row -->
                  <button type="submit" class="btn btn-info">Submit</button>
               
                {{--{!! Form::close() !!}--}}
                </form>



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

