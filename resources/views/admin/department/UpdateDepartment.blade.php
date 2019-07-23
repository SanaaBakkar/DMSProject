@extends('layouts.admin')

@section('content')



<div class="container">

  @if(!empty(Session::get('error')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Department Already Exist !
        </div>
      @endif

      
    <h4>Update Group</h4><hr>

  <form method="post" action="{{url('/editdepartment',array($department->id))}}">
                    {{ csrf_field() }}

    <i class="list-group-item">

      <div class="d-flex justify-content-center">
             Group Name: &nbsp;<input class="form-control" type="text" name="name" value="{{$department->name}}" style="width: 50%"/>
       </div>      <br>
       <center><input type="submit" class="btn btn-primary" name="save" value="Edit"></center>            

    </i>
  </form>
   <br>
</div>



@endsection