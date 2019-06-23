@extends('layouts.app')
@section('content')



<div class="container">

<h3 class="well"><img height="50px" src="/img/AddFileIcon.ico">&nbsp;Add a document </h3><hr>

  @if(!empty(Session::get('add-success')))
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                 Your file has been successfully added
          </div>
  @endif


<i class="list-group-item">
<form method="post" action="{{url('upload')}}" enctype="multipart/form-data">

  {{csrf_field()}}

  <div class="input-group hdtuto control-group lst increment" >

    <input type="file" name="doc_name[]" class="myfrm form-control"><br><br><br>

       <div class="form-group">
              <label >Description:</label><br>
              <textarea rows="3" cols="100" name="description" value="description"></textarea>
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>


  </div>
</form>        
</i>

</div>



<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-primary").click(function(){ 

          var lsthmtl = $(".clone").html();

          $(".increment").after(lsthmtl);

      });

    });

</script>


</

</html>


@endsection