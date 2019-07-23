@extends('layouts.app')

@section('content')
<body>
        @if(!empty(Session::get('delete-file')))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    File Deleted successfully
            </div>
        @endif

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
    			<td><a href="/visualize/{{$doc->id}}">{{$doc->doc_name}}</a></td>
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

     <!-- Script of Datatable-->		
<script type="text/javascript">

  $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

</script>

</body>
@endsection