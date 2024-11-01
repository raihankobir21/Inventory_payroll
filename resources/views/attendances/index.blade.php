@extends('layouts.app')
	
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-4">
                    <h4>Take Attendance</h4>
                  </div>
				  
				  <div class="col-sm-4">
                    <h5>Time: {{ date("d M Y h:i:s A") }}</h5>
                  </div>
                  <div class="col-sm-4 float-sm-right">
                        <a href="{{ route('home') }}" class="btn btn-info float-sm-right"><i class="fa fa-angle-double-left"></i> Back</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
               
              
              <form method="POST" action="{{ route('attendances.store') }}" enctype= multipart/form-data>
              @csrf
              <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Staff ID</label>
                        <input type="text" class="form-control staff_id" id="staff_id" name="staff_id" value="{{ old('staff_id') }}" placeholder="Staff ID">
                        @error('staff_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                   <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>

              </form>


              </div>
              </div>
        </div>
    </div>
</div>

<script>
		$(document).ready(function(){
			
				$(".staff_id").focus();
				
		});
</script>
@endsection
              