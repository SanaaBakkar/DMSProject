@extends('layouts.admin')

@section('content')

<div class="container">
    <h4>Update Group</h4><hr>

  <form method="post" action="{{url('/editgroup',array($group->id))}}">
                    {{ csrf_field() }}

    <i class="list-group-item">

      <div class="d-flex justify-content-center">
             Group Name: &nbsp;<input class="form-control" type="text" name="name" value="{{$group->name}}" style="width: 50%"/>
       </div>      <br>
       <center><input type="submit" class="btn btn-primary" name="save" value="Edit"></center>            

    </i>
  </form>
   <br>
</div>



@endsection