@extends('layouts.apps')

@section('content')
<body>
        @if(!empty(Session::get('delete-file')))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    File Deleted successfully
            </div>
        @endif

        <?php 
                 ?>
<div class="container">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
        <thead>
            <tr>
                <th>Document Name</th>
                <th>Description</th>
                <th>Created by</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alldocs as $doc)
            <tr>
                <td>
                  <div class="row">
                    <div class="col-2">
                      <a href="detail/{{$doc->id}}"><img src="/img/document.png" style="width: 80%"></a>
                    </div>

                  <div class="col-10">
                    <a href="detail/{{$doc->id}}" target="_blank">{{$doc->doc_name}}</a><br> 
                    Created at <?php $date = Carbon\Carbon::parse($doc->created_at);
                                echo $date->toFormattedDateString(); ?><br>

                   <!-- Button Favorite-->                      
                   <a href="/favorite/{{$document->id}}" class="text-dark" title="favorite_doc" id="favorite" ><i class="fa fa-heart" id="heart"></i> Favorite</i></a>

                </td>
                <td>{{$doc->doc_description}}</td>
                <td>{{$doc->doc_prepared_by}}</td>
                <td><a href="/visualize/{{$doc->id}}" title="detail" ><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                    @if($role->name=='Coordinator')
                  <a href="/delete/{{$doc->id}}" title="delete" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    @endif
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
    
     <!-- Script of Datatable-->		
<script type="text/javascript">

  $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

</script>

</body>
@endsection