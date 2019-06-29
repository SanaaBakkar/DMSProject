@extends('layouts.admin')

@section('content')

  <div class="container">
    @if(!empty(Session::get('create')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                User Created Successfuly
        </div>
      @endif

    @if(!empty(Session::get('error')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                User Already Exist !
        </div>
      @endif

    @if(!empty(Session::get('update')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                User updated Successfuly
        </div>
      @endif

       @if(!empty(Session::get('delete')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                User Deleted
        </div>
      @endif

<h4>List of users</h4><hr>
  <i class="list-group-item">
<a href="{{url('/AddUser')}}" style="float: right"><input type="button" class="btn btn-dark" value="Add User"/></a>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
           <thead>
           	<tr>
           		<th>id</th>
           		<th>Name</th>
           		<th>Email</th>
           		<th>Group Name</th>
           		<th>Role</th>
              <th>Action</th>
           	</tr>
           </thead>
           <tbody>
           	@foreach($users as $user)
           	<tr>
      	     	<td>{{$user->id}}</td>
      	     	<td>{{$user->name}}</td>
      	     	<td>{{$user->email}}</td>
      	    <?php $group = App\Group::find($user->group_id) ?>
      	     	<td>{{$group->name}}</td>
      	    @if($user->admin==1) 	
      	     	<td>Admin</td>
      	     @else	
      	     	<td>Not Admin</td>
      	     @endif	
              <td><a href="/updateuser/{{$user->id}}"><i class="fa fa-edit" style="color: lightskyblue"></i></a>
                &nbsp;&nbsp;
              <a href="/deleteuser/{{$user->id}}"><i class="fa fa-trash" style="color: red"></i></a></td>
           	</tr>
           </tbody>
           @endforeach
      </table>
 </i>

     <!-- Script of Datatable-->		
    <script type="text/javascript">

      $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });

    </script>

</div>
@endsection