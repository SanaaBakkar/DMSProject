@extends('layouts.app')

@section('content')
<body>


    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
    	<thead>
    		<tr>
    			<th>Document Name</th>
    			<th>Description</th>
    			<th>Created by</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($alldocs as $doc)
    		<tr>
    			<td><a href="/visualize/{{$doc->id}}">{{$doc->doc_name}}</a></td>
    			<td>{{$doc->doc_description}}</td>
    			<td>{{$doc->doc_prepared_by}}</td>
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