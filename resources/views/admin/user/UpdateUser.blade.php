@extends('layouts.admin')

@section('content')

<div class="container">
	
	<i class="list-group-item">

		<h4>Edit User</h4><hr><br>
		 <form method="post" action="{{ url('/edituser',array($user->id)) }}">
      	        {{ csrf_field() }}

	<i class="list-group-item">
     
			<div class="form-group row">
				<div class="col-sm-4">
					Name:<input type="text" class="form-control" name="name" value="{{$user->name}}" />
				</div>

				<div class="col-sm-2">
				</div>	

				<div class="col-sm-6">
					Email: <input type="email" name="email" class="form-control" value="{{$user->email}}">
				</div>	

				<div class="col-sm-4" style="margin: 20px 0px 0px 0px">
					Groupe Name :<select class="custom-select mr-sm-2" name="group_name">
									<option value="{{$group_user->id}}" selected>{{$group_user->name}}</option>
									@foreach($listgroups as $group)
									<option value="{{$group->id}}">{{$group->name}}</option>
									@endforeach
								</select>
				</div>	

				<div class="col-sm-4" style="margin: 20px 0px 0px 0px">
					Role : <select class="custom-select mr-sm-2" name="role_id" required>
					            	<option value="{{$role_user->id}}" selected>{{$role_user->name}}</option>
									@foreach($listroles as $role)
									<option value="{{$role->id}}">{{$role->name}}</option>
									@endforeach
						   </select>
				</div>	

				<div class="col-sm-4" style="margin: 20px 0px 10px 0px">
					It is an admin? <select class="custom-select mr-sm-2" name="isadmin">
									@if($user->admin==1)
									    <option value="1" selected>Yes</option>
									    <option value="0">No</option>
									 @else
									    <option value="0" selected>No</option>   
									    <option value="1" >Yes</option>
									</select>
									@endif
				</div>	<br>
			
			<div class="col-sm-4">
				<input type="submit" name="update" class="btn btn-primary" value="Update">	
			</div>
			</div><br>
	</i>	
		</form>		

    </i>
</div>


@endsection