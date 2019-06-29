@extends('layouts.admin')

@section('content')

  <div class="container">
    @if(!empty(Session::get('create')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Group Created Successfuly
        </div>
      @endif


    @if(!empty(Session::get('update')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Group updated Successfuly
        </div>
      @endif

       @if(!empty(Session::get('delete')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Group Deleted
        </div>
      @endif

<h4>List of Groups</h4><hr>

  <form method="post" action="{{url('/savegroup')}}">
                    {{ csrf_field() }}

    <i class="list-group-item">
       <div class="row">
         <div class="col-md-6">
               <input class="form-control" type="text" name="name" placeholder="Name of group" required/>
         </div>
         <div class="col-md-6">
           <input type="submit" class="btn btn-dark" name="save" value="Add group">
         </div>
       </div>
    </i>
  </form>
   <br>

  <i class="list-group-item">
        
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
           <thead>
           	<tr>
           		<th>id</th>
           		<th>Name</th>
              <th>Action</th>
           	</tr>
           </thead>
           <tbody>
           	@foreach($groups as $group)
           	<tr>
      	     	<td>{{$group->id}}</td>
      	     	<td>{{$group->name}}</td>
              <td>
                <a href="/updategroup/{{$group->id}}"><i class="fa fa-edit" style="color: lightskyblue"></i></a>
                &nbsp;&nbsp;
                <a href="/deletegroup/{{$group->id}}"><i class="fa fa-trash" style="color: red"></i></a></td>
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