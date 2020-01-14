@extends('layouts.apps')

@section('content')

<div class="container">

 <div class="row" style="margin-top: 150px">
 	<div class="col-md-4">
    		    <div class="card profile-card-3">
    		        <div class="background-block">
    		            <img src="img/user-setting.png" alt="profile-sample1" class="background"/>
    		        </div>
    		        <div class="profile-thumb-block">
    		            <img src="img/user_icon.png" class="profile"/>
    		        </div>
    		        <div class="card-content">
                    <h2>{{Auth::user()->name}}</h2>
               <?php $role = App\Role::find(Auth::user()->role_id)->first() ?>
                    	<small>{{$role->name}}</small>
               <?php $department = App\Departement::find(Auth::user()->departement_id);?>
                    <p><b>Department:</b> {{$department->name}} </p>

                    
                    </div>
                </div>   
    </div>

    <div class="col-md-8"> 
       <div class="card mx-xl-6"  style="background-color: rgba(0, 123, 255, 0.25)">
           <!--- Updated Message ---->
          @if(!empty(Session::get('update')))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Your profile updated Successfuly
            </div>
          @endif
           <!--- Updated Message ---->

          @if(!empty(Session::get('error')))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        Your password and confirmation password do not match !
            </div>
          @endif
             <div class="card-body">
                <p class="h4 text-center py-4">My Profile</p>

          <form method="post" action="{{ url('/editUserProfile',Auth::user()->id) }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="col-md-6">

                      <label class="col-form-label" for="name">Your Name</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                              <i class="fa fa-user"> </i>
                          </div>

                          <input id="name" name="name" type="text" value="{{Auth::user()->name}}" class="form-control " required>

                       </div>

                        <label class="col-form-label" for="email">Your email</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                              <i class="fa fa-envelope"> </i>
                          </div>

                          <input id="email" name="email" type="text" value="{{Auth::user()->email}}" class="form-control " required>

                       </div>


                  </div>
                 
                <div class="input-group">
                    <div class="col-md-6">
                       <label class="col-form-label" for="new_password">New Password</label>

                      <div class="input-group">
                          <div class="input-group-addon">
                              <i class="fa fa-lock"> </i>
                          </div>

                          <input type="password" id="new_password" name="new_password" class="form-control" >                          
                       </div>
                       <input type="checkbox" id="new_pass">show password
                   </div>
                   
                    <div class="col-md-6">

                       <label class="col-form-label" for="confirm_password">Confirm Password</label>

                      <div class="input-group">
                          <div class="input-group-addon">
                              <i class="fa fa-lock"> </i>
                          </div>

                          <input id="confirm_password" name="confirm_password" type="password" class="form-control ">
                      </div>
                     <input type="checkbox" id="confirm_pass">show password

                  </div>
              </div>
            </div>    
          <center><input type="submit" class=" btn btn-primary" name="update" value="update"></center>
   </form>

             </div>
        </div>
    </div>

 </div>
	
</div>

<script>
$(document).ready(function(){
    $('#new_pass').on('change', function(){
        $('#new_password').attr('type',$('#new_pass').prop('checked')==true?"text":"password"); 
    });
});

$(document).ready(function(){
    $('#confirm_pass').on('change', function(){
        $('#confirm_password').attr('type',$('#confirm_pass').prop('checked')==true?"text":"password"); 
    });
});

</script>

@endsection