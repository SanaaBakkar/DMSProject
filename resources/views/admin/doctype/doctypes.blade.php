@extends('layouts.admin')

@section('content')

<div class="container">
      @if(!empty(Session::get('create')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Document Type Created Successfuly
        </div>
      @endif

     @if(!empty(Session::get('error')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Type Already Exist !
        </div>
      @endif

    @if(!empty(Session::get('update')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Document Type updated Successfuly
        </div>
      @endif

       @if(!empty(Session::get('delete')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Document Type Deleted
        </div>
      @endif


<h4>List of users</h4><hr>

       <form method="post" action="{{url('/savetype')}}">
                         {{ csrf_field() }}

         <i class="list-group-item">
            <div class="row">
              <div class="col-md-6">
                    <input class="form-control" type="text" name="name" placeholder="Name of group" required />
              </div>
              <div class="col-md-4">
                    <input class="form-control" type="text" name="extension" placeholder="Extension" required />
              </div><br>
              <div class="col-md-12" style="margin: 20px 0px 0px 0px">
                <center><input type="submit" class="btn btn-dark" name="save" value="Add Type"></center>
              </div>
            </div>
         </i>
       </form>
   <br>

     <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
          <thead>
               <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>extension</th>
                    <th>Action</th>
               </tr>
          </thead>
          <tbody>
               @foreach($doc_types as $type)
               <tr>
                    <td>{{$type->id}}</td>
                    <td>{{$type->typdoc_title}}</td>
                    <td>{{$type->extension}}</td>
                    <td><a href="/updatetype/{{$type->id}}"><i class="fa fa-edit" style="color: lightskyblue"></i></a>
                     &nbsp;&nbsp;
                   <a href="/deletetype/{{$type->id}}"><i class="fa fa-trash" style="color: red"></i></a></td>
               </tr>
          </tbody>
          @endforeach
     </table>

</div>
    
@endsection