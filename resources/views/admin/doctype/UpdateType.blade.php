@extends('layouts.admin')

@section('content')

<div class="container">
    <h4>Update Type</h4><hr>

  <form method="post" action="{{url('/edittype',array($type->id))}}">
                    {{ csrf_field() }}

    <i class="list-group-item">

       <div class="row">
         <div class="col-md-6">
             <label>Donomination</label>
             <input class="form-control" type="text" name="name" value="{{$type->typdoc_title}}">
         </div>
         <div class="col-md-6">
             <label>Extension</label>
             <input class="form-control" type="text" name="extension" value="{{$type->extension}}" />
         </div>
       </div><br>
       <center><input type="submit" class="btn btn-primary" name="save" value="Edit"></center>            

    </i>
  </form>
   <br>
</div>



@endsection