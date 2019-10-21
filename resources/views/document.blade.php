@extends('layouts.app')

@section('content')
<body>
 
<form>
  <!----Top menu ----->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
          <td width="5%" align="left" class="subtitle_3"> </td>
          <td width="30%" align="left" class="subtitle_3"> 
                <a class="list-group-item" href="{{url('listdocuments')}}"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp; List of documents</a></td>
     @if(count($role) > 0)     
          @if($role->name=='Contributor' or $role->name=='Collaborator' or $role->name=='Coordinator')      
          <td width="30%" align="left" class="subtitle_3">  <a class="list-group-item" id ="add_doc" href=" {{url('upload')}}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Add New document</a></td>
          <td width="30%" align="left" class="subtitle_3">  <a class="list-group-item" href="#"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Compare documents</a></td>
          <td width="5%" align="left" class="subtitle_3"></td>
          @endif
      @endif    
    </tr>
 </table><br>

<!--- Messages Info --->
    @if(!empty(Session::get('delete-file')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                File Deleted successfully
        </div>
      @endif 
      
     @if(!empty(Session::get('WF-created')))
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  Workflow Started 
          </div>
     @endif

      @if(!empty(Session::get('WF-info')))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Sorry, Workflow Already started !
        </div>
      @endif

     @if(!empty(Session::get('update-doc')))
        <div class="alert alert-primary">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                 Document updated successefully !
        </div>
      @endif
      @if(!empty(Session::get('Workflow saved')))
        <div class="alert alert-dark">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Workflow saved successefully !
        </div>
      @endif

<!---Table of documents  --->      
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="95%" style="margin: 0px 0px 0px 30px">

         <thead>
            <tr>
              <th>N° </th>
              <th>Title </th>
               <th>Description</th>
              <th>Date </th>
              <th>Created by </th>
              <th>Status </th>
              <th>Action </th>

            </tr>
        </thead>
        <tbody>
           @foreach($documents as $document)
          <tr>

              <td>{{$document->id}}</td>
              <td width="30%"><a href="visualize/{{$document->id}}"  target="_blank">
              {{$document->doc_name}}</a></td>
              <td width="20%">{{$document->doc_description}}</td>
              <td>{{$document->created_at}}</td>
              <td>{{$document->doc_prepared_by}}</td>
              <td>{{$document->doc_status}}</td>
              <td>&nbsp;&nbsp;
                  <a href="/detail/{{$document->id}}" id="detail_doc" title="detail" ><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                    <!-- Button Edit-->
                  <a href="/update/{{$document->id}}" id="edit_doc" title="edit" ><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;

                  @if($document->doc_status=='Not yet started')
                    <!-- Button Start Workflow-->
                  <a href="/Typeworkflow/{{$document->id}}" title="start workflow" id="wf"><i class="fas fa-sitemap"></i></a>&nbsp;&nbsp;&nbsp;
                  @else
                  <a href="/viewworkflow/{{$document->id}}" title="view workflow" ><i class="fas fa-sitemap"></i></a>&nbsp;&nbsp;&nbsp;
                  @endif
                  <a href="/workflow/{{$document->id}}" title="start workflow" hidden><i class="fas fa-sitemap"></i></a>&nbsp;&nbsp;&nbsp;
                   <a href="/workflowGroup/{{$document->id}}" title="start workflow" hidden><i class="fas fa-sitemap"></i></a>
                    <!-- Button Delete-->
                  <a href="/delete/{{$document->id}}" title="delete" id="delete_doc" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                  
          </tr>
          @endforeach
        </tbody>
                      

   </table>    
         
</form>
  <!-- Script of Datatable-->		
<script type="text/javascript">

  $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

</script>

@endsection
