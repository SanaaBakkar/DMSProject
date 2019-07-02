@extends('layouts.admin')

@section('content')

<div class="container">

<h4>List of documents</h4><hr>
  <i class="list-group-item">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">
          <thead>
               <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Prepared by</th>
                    <th>Reviewed by</th>
                    <th>Approved by</th>
                    <th>Status</th>
                    <th>Action</th>
               </tr>
          </thead>
          <tbody>
               @foreach($documents as $document)
               <tr>
                    <td>{{$document->id}}</td>
                    <td><a href="/visualize/{{$document->id}}">{{$document->doc_name}}</a></td>
                    <td>{{$document->doc_description}}</td>
                    <td>{{$document->doc_prepared_by}}</td>
                    <td>{{$document->doc_reviewed_by}}</td>
                    <td>{{$document->doc_approved_by}}</td>
                    <td>{{$document->doc_status}}</td>
                    <td><center><a href="/viewdoc/{{$document->id}}"><i class="fa fa-eye"></i></a></center></td>
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