@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

		<form method="POST" action="{{ route('roles.store') }}">
			@csrf
		
		<div class="row">
                               
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="" class="form-label">Role Name</label>
					
					 <input type="text" name="name" placeholder="Enter roll name" class="form-control" value="">
			  
					@error('name')
						<span class="invalid-feedback" >
							<b>{{ $message }}</b>
						</span>
					@enderror
				</div>
			</div>
			
			
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="form-group">
					<label for="" class="form-label">Serial Order</label>
					
					 <input type="text" name="order" placeholder="" class="form-control" value="">
			  
					@error('order')
						<span class="invalid-feedback" >
							<b>{{ $message }}</b>
						</span>
					@enderror
				</div>
			</div>
		
	
		
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			<div class="form-group">
				<label for="" class="form-label">Show in Dropdown</label>
				<br/>
				<input type="checkbox" name="dropdown_show" class="form-control"  value="">
          
					
				@error('dropdown_show')
					<span class="invalid-feedback" >
						<b>{{ $message }}</b>
					</span>
				@enderror
			</div>
		</div>
		</div>
		
			<div class="row">							
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="table-responsive">
						<table class="table table-strip">
								<tr>
									<th>Module Name</th>
									<th>Permission <span style="float:right"><span style="float:right"><input type="checkbox" name="" value="1" id="checkAll" > Select All</span></span></th>
								</tr>
								
								@foreach($reArrangePermission as $key => $value )
								
									<tr>
										<th> {{ $key }}</th>
										<td colspan="2">
											@foreach($value as $keySub => $valueSub )
											
												<label><input type="checkbox" name="permission[]" value="{{$keySub}}" class="name" ></label>
											{{ $valueSub }}
											@endforeach

										</td>
										
									</tr>
								@endforeach
								
								
								@error('permission')
									<tr>
										<th> </th>
										<th> 
											<span class="invalid-feedback" >
												{{ $message }}
											</span>
										</th>
									</tr>			
								@enderror
						</table>
					</div>
				</div>
				
				
			</div>
			
			
			<div class="row">
			
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
				</div>
			</div>
			
							
		</form>
		
		
	<script>
			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
	</script>
	
	
@endsection