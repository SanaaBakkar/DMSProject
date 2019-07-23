@extends('layouts.admin')

@section('content')

<div class="container">
	
	<i class="list-group-item">

		<h4>Add User</h4><hr><br>
		 <form method="post" action="{{ url('/saveuser')}}">
      	        {{ csrf_field() }}

	<i class="list-group-item">
     
			<div class="form-group row">
				<div class="col-sm-4">
					Name:<input type="text" class="form-control" name="name" placeholder="Name" required/>
				</div>

				<div class="col-sm-4">
					Email: <input type="email" name="email" class="form-control" placeholder="Email" required />
				</div>	

				<div class="col-sm-4">
					Mot de passe: <input type="password" class="form-control" name="password" id="password" required><input type="checkbox" id="checkbox">show password
				</div>	

				<div class="col-sm-4" style="margin: 20px 0px 0px 0px">
					Groupe Name :<select class="custom-select mr-sm-2" name="group_id" >
					            	 <option value="" disabled selected>Choose a group</option>
									@foreach($listgroups as $group)
									<option value="{{$group->id}}">{{$group->name}}</option>
									@endforeach
								</select>
				</div>	

				<div class="col-sm-4" style="margin: 20px 0px 0px 0px">
					Role : <select class="custom-select mr-sm-2" name="role_id" required>
					            	 <option value="" disabled selected>Choose a role</option>
									@foreach($listroles as $role)
									<option value="{{$role->id}}">{{$role->name}}</option>
									@endforeach
							</select>
				</div>	

				<div class="col-sm-4" style="margin: 20px 0px 10px 0px">
					It is an admin? <select class="custom-select mr-sm-2" name="admin" required>
					            	    <option value="" disabled selected>Admin</option>
									    <option value="1">Yes</option>
									    <option value="0">No</option>
									</select>
									
				</div>	<br>
			
			<div class="col-sm-4">
				<input type="submit" name="Save" class="btn btn-primary" value="Save">	
			</div>
			</div><br>
	</i>	
		</form>		

    </i>
</div>

<script>
$(document).ready(function(){
    $('#checkbox').on('change', function(){
        $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
    });
});
</script>
@endsection