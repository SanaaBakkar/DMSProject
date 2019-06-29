@extends('layouts.admin')

@section('content')

<div class="container">

  <h4>Group Review and Approve</h4><hr>
   <i class="list-group-item">

     <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
          <thead>
          	<tr>
          		<th>id</th>
          		<th>Document Name</th>
          		<th>Type</th>
              <th>Created by</th>
              <th>Assign to</th>
          		<th>Priority</th>
          		<th>Status</th>
                    <th>Action</th>
          	</tr>
          </thead>
          <tbody>
          	@foreach($workflows as $workflow)
             <?php $doc = App\Edocument::find($workflow->id_doc); 
                   $type = App\Etypdoc::find($doc->typdoc_id);?>
          	<tr>
     	     	<td>{{$workflow->id}}</td>
     	     	<td>{{$doc->doc_name}}</td>
            <td>{{$type->typdoc_title}}</td>
     	     	<td>{{$workflow->created_by}}</td>
     	     	<td>{{$workflow->assign_to}}</td>
            <td>{{$workflow->priority}}</td>
         @if(!empty($workflow->status))  
     	     	<td>{{$workflow->status}}</td>
         @else
            <td>On hold</td>
         @endif 
                    <td><center><a href="/ViewWF/{{$workflow->id}}"><i class="fa fa-eye"></i></a></center></td>
          	</tr>
          </tbody>
          @endforeach
     </table>
   </i>
</div>

<!-- Script of Datatable-->      
    <script type="text/javascript">

      $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });

    </script>
@endsection