@extends('layouts.apps')

@section('content')
 

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
<form>
<div style="margin: 10px 10px; border-style: groove; ">
   <div class="row">

     <div class="col-6 col-md-2">
        <h5>Documents</h5>
        <a href="{{url('listdocuments')}}" style="margin-left:1em">All Documents</a><br>
        <a href="{{url('document')}}" style="margin-left:1em">My Documents</a><br>
        <a href="#" style="margin-left:1em">I'm Editing</a><br>
        <a href="{{url('my_favorites')}}" style="margin-left:1em">Favorite</a> 
     </div>

     <div class="col-12 col-md-8">
       @if($role->name=='Contributor' or $role->name=='Collaborator' or $role->name=='Coordinator')      
         <a class="list-group-item" id ="add_doc" href=" {{url('upload')}}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Add New document</a>
       @endif
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" style="margin: 0px 0px 0px 30px">
          <thead>
            <tr>
              <th>
              </th>
            </tr>
          </thead>
          <tbody>

           @foreach($documents as $document)
       <?php    
             $today = new DateTime();
             $date_created  = new DateTime($document->updated_at);
             $days = $date_created->diff($today);
        ?>
            <tr>
              <td>
                <div class="row">
                  <div class="col-2">
                    <a href="detail/{{$document->id}}" id="#detail_doc"><img src="/img/document.png" style="width: 80%"></a>
                  </div>

                  <div class="col-10">
                    <a href="detail/{{$document->id}}" target="_blank">{{$document->doc_name}}</a><br> 

                    <!-- Display Date of creation and last update if it exists -->  
                    @empty($document->doc_reviewed_by)

                      <?php echo $days->format('Created %a days ago by '. $document->doc_prepared_by ); ?><br>

                    @endempty

                    @isset ($document->doc_reviewed_by)

                      <?php echo $days->format('Modified %a days ago by '.$document->doc_reviewed_by ); ?><br>

                     @endisset
                     <!-- End of Date Display --> 

                      {{$document->doc_description}}<br>

          <!-- Testing if the document belong to the favorites --> 
          <?php $favorite= App\Favorite::where('document_id',$document->id)->first(); ?>

            @if(empty($favorite))
                    <!-- Button Favorite-->                      
                  <a href="/favorite/{{$document->id}}" class="text-dark" title="favorite_doc" ><i class="fa fa-heart" ></i> Favorite</a>&nbsp;&nbsp;
            @else
              <!-- Button Favorite-->                      
                  <a href="/unfavorite/{{$document->id}}" class="text-dark" title="favorite_doc"  ><i class="fa fa-heart" style="color: red"></i> Favorite</a>&nbsp;&nbsp;
            @endif
          <!-- End Testing --> 
          
                    <!-- Button Edit-->
                  <a href="/update/{{$document->id}}" class="text-dark" title="edit" id="edit_doc" ><i class="fa fa-edit" aria-hidden="true"> Edit</i></a>&nbsp;&nbsp;

                    <!-- Button Start Workflow-->
                  @if($document->doc_status=='Not yet started')
                   <a href="/Typeworkflow/{{$document->id}}" class="text-dark" title="start workflow" id="wf"><i class="fas fa-sitemap">Start Workflow</i></a> &nbsp;&nbsp;

                  @else

                  <a href="/viewworkflow/{{$document->id}}" class="text-dark" title="view workflow" ><i class="fas fa-sitemap">View Workflow</i></a>&nbsp;&nbsp;
                  @endif

                   <!-- Button Delete-->
                  <a href="/delete/{{$document->id}}" class="text-dark" title="delete" id="delete_doc" ><i class="fa fa-trash" >Delete </i></a>&nbsp;&nbsp;

                   <!-- Document ID-->
                  <a href="/workflowGroup/{{$document->id}}" title="start workflow" hidden><i class="fas fa-sitemap"></i></a>
                  

                  </div>
                </div>       

              </td>

            </tr>
              @endforeach
         </table>
       </div>
    </div>
  </div>  

  
</form>

  <!-- Script of Datatable-->		
<script type="text/javascript">

  $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

</script>

@endsection
