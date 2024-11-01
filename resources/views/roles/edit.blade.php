@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Role</h2>
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

<form method="POST" action="{{ route('roles.update', $role->id) }}">
    @csrf
    @method('PUT')

    <div class="row">
        
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
            </div>
        </div>
		
		
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="form-group">
				<label for="" class="form-label">Serial Order</label>
				
				 <input type="text" name="order" placeholder="" class="form-control" value="{{ $role->order }}">
          
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
				<input type="checkbox" name="dropdown_show" class="form-control"  value="{{ $role->dropdown_show }}" {{ (  $role->dropdown_show == 1)? 'checked' : ''}}>
          
					
				@error('dropdown_show')
					<span class="invalid-feedback" >
						<b>{{ $message }}</b>
					</span>
				@enderror
			</div>
		</div>
	</div>
		
		
		
		
		<div class="row">							
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
				<div class="table-responsive">
					<table class="table">
							<tr>
								<th>Module</th>
								<th>Permission <span style="float:right"><input type="checkbox" name="" value="1" id="checkAll" > Select All</span></th>
							</tr>
							
							@foreach($reArrangePermission as $key => $value )
							
								<tr>
									<th> {{ $key }}</th>
									<td colspan="2">
										@foreach($value as $keySub => $valueSub )
											
											<label><input type="checkbox" name="permission[]" value="{{$keySub}}" class="name" {{ in_array($keySub, $rolePermissions) ? 'checked' : '' }}></label>
											{{ $valueSub }}
										@endforeach
									</td>
								</tr>
							@endforeach
					</table>
			</div>
		</div>
		</div> 
		
		
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Update</button>
        </div>
    </div>
</form>


	<script>
			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
	</script>
	
@endsection