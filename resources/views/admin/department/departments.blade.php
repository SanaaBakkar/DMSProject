@extends('layouts.admin')

@section('content')

  <div class="container">
    @if(!empty(Session::get('create')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Department Created Successfuly
        </div>
      @endif


    @if(!empty(Session::get('update')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Department updated Successfuly
        </div>
      @endif

     @if(!empty(Session::get('error')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Department Already Exist !
        </div>
      @endif
  
       @if(!empty(Session::get('delete')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Department Deleted
        </div>
      @endif

<h4>List of Departments</h4><hr>

  <form method="post" action="{{url('/savedepartment')}}">
                    {{ csrf_field() }}

    <i class="list-Department-item">
       <div class="row">
         <div class="col-md-6">
               <input class="form-control" type="text" name="name" placeholder="Name of Department" required/>
         </div>
         <div class="col-md-6">
           <input type="submit" class="btn btn-dark" name="save" value="Add Department">
         </div>
       </div>
    </i>
  </form>
   <br>

  <i class="list-Department-item">
        
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
           <thead>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
           </thead>
           <tbody>
            @foreach($departments as $department)
            <tr>
              <td>{{$department->id}}</td>
              <td>{{$department->name}}</td>
              <td>
                <a href="/updatedepartment/{{$department->id}}"><i class="fa fa-edit" style="color: lightskyblue"></i></a>
                &nbsp;&nbsp;
                <a href="/deletedepartment/{{$department->id}}"><i class="fa fa-trash" style="color: red"></i></a></td>
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