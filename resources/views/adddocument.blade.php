@extends('layouts.apps')
@section('content')



<div class="container">

<h3 class="well"><img height="50px" src="/img/AddFileIcon.ico">&nbsp;Add a document </h3><hr>

  @if(!empty(Session::get('success')))
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                 Your file has been successfully added
          </div>
  @endif

  @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                     @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                     @endforeach
                </ul>
          </div>
  @endif

<i class="list-group-item">
<form method="post" action="{{url('upload')}}" enctype="multipart/form-data">

  {{csrf_field()}}

  <div class="input-group hdtuto control-group lst increment">

      <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload" aria-describedby="fileHelp">
      <small id="fileHelp" class="form-text text-muted">Please upload your file. Size of the file should not be more than 2MB.</small><br><br>
                            
                            
      <div class="form-group">
            <label >Description:</label><br>
            <textarea rows="3" cols="100" name="description" value="description"></textarea>
      </div>
  </div>

  <div class="col-lg-3 col-md-4 ftco-animate fadeInUp ftco-animated">
            <button type="submit" class="btn btn-secondary">Submit</button>

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



</html>


@endsection