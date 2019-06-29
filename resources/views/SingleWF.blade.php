@extends('layouts.app')
@section('content')
 
<div class="container">
  <div>
    
 
          <div class="form-group">
            <h3><i class="list-group-item"><i class="fas fa-sitemap"></i>&nbsp;&nbsp; Start Workflow</i></h3><hr>
          </div>

             @if(!empty(Session::get('info-phone')))
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  Workflow Started 
          </div>
             @endif

              @if(!empty(Session::get('Error-info')))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                 Please fil out the assignee to field
          </div>
             @endif

        
        <div id="type" style="display: block">
            <label><b>Workflow: </b></label>
            <select class="form-control" name="typeWF" onChange="ShowHide(this.value)" style="width: 35%; display: inline;">
                <option value="Choose">Please select a workflow</option>
                              <?php foreach ($wftypes as $wftype): ?>
                <option value="{{$wftype->id}}">{{$wftype->name}}</option>
                              <?php endforeach; ?>
            </select>
       </div>

  <form method="post" action="{{ url('/workflowS',array($documents->id)) }}">
            {{csrf_field()}}

            <!-- Modal of button Select of a single Assignee -->           
   <div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Users list</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-sm-10">
              <div style="overflow: scroll; height: 290px;">

                <table class="table table-sm" width="80%" border="0" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr class="table-secondary">
                      <th colspan="2"><center>Name</center></th>
                      </tr>
                  </thead>
                            <?php foreach ($listUsers as $listUser):?>
                    <tr>
                      <td align="left" class="subtitle_3">{{$listUser->name}}</td>

                      <td align="right"><input type="radio" name="id_user" value ="{{$listUser->id}}" ></input></td>
                    </tr>
                            <?php  endforeach; ?>
                </table>  
            </div>
            </div>  
              
            </div>
       
       </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-info" data-dismiss="modal">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>
</div>
<!--- End Modal --->  
      <!-- Assign a new Task Option-->  
       
          <div id="1" class="form-group" style="display: block;">
          
            <i class="list-group-item">              
            <label><b>Assign a new Task Option</b></label><br>
              <input type="text" name="type_Workflow" value="1" hidden>
              Description:<br>
               <textarea style="width: 80%; height: 20%" name="description" required></textarea><br><br>

              <div class="row">
                    <div class="col">
                     <label for="start"><i style="font-size:24px" class="fa">&#xf073;&nbsp;</i>Due:</label>
                       <input type="date" class="form-control" id="due" name="Date" placeholder="MM-DD-YY" style="width: 35%" required>
                 </div>
                    <div class="col">
               Priority:
              <select name="priority" class="form-control" style="width: 30%">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
               </select>
                    </div>                    
                </div>    <br>       

        <b>Assignee</b><hr>
        Assign to:* 
        <input type="button" name="id_user" class="btn btn-info" data-toggle="modal" data-target="#myModal" value="Select" required><br><br>
        
        <b>Document</b>
        <div id="doc" style="display: block;">
        <i class="list-group-item">
        <table name="doc_info">
          <tr>
            <td width="20%"><img height="50px" src="/img/fileicon.png" /></td>
            <td width="60%">{{$documents->doc_name}} <br>
              Description : {{ $documents->doc_description }}<br>
              Modified on : {{ $documents->updated_at}}</td>
          </tr>
        </table>
        </i>
          </div><br>

      <!--    <div id="removedoc" style="display: none;">
            <select class="form-control" disabled> <option >No items selected</option></select>
          </div>-->

        <!-- Trigger the modal with button Add: Code Modal above -->
        <!--
        <button type="button" class="btn btn-info" style="display: inline;" value="add" onclick="Show(this.value)" data-toggle="modal" data-target="#myModal">Add</button>
        <button type="button" class="btn btn-danger" style="display: inline;" value="remove" onclick="Show(this.value)" >Remove</button><br><br>
-->
        <b>Other Options:</b>
        <input type="checkbox" id="email" name="email">Send email
      </i><br>


      <input type="submit" class="btn btn-info" name="startwf" value="Start Workflow">
          <input type="reset" class="btn btn-danger" name="cancel" value="Cancel">
          </div>
                 

      <!-- End -->   

    
     </form>  

  </div> 
</div>


<script type="text/javascript">

/***** Display each type of workflow *****/
 function ShowHide(val) {

     var typewf1 = document.getElementById("1");
     var url = "";

    if (val == '1') {
      typewf1.style.display = 'block';

    }else if (val == '2') {
      window.location.href = '{{url("workflowGroup/{$documents->id}")}}';
      
    } else if (val=='3'){
     window.location.href = '{{url("workflowParallel/{$documents->id}")}}';
    }
   
  }
/***** Remove and add a document in workflow part *****/  
  function Show(val) {
        var typ1 = document.getElementById("doc");
            var typ2 = document.getElementById("removedoc");


    if (val == 'remove') {
      typ1.style.display = 'none';
      typ2.style.display = 'block';
    }else{
        typ1.style.display = 'block';
      typ2.style.display = 'none';  
    }
    }

</script>


@endsection




<!--public function AddWF(Request $request,$id)
{
             $documents=EDocument::find($id);

        $this->validate($request, [
                'type_WF'=>'required',
                'description'=>'required',
                'priority'=>'required',
                'id_user'=>'required'

            ]);

    $workflow = new Workflow;
    $workflow->type = $request->input('type_WF');
    $workflow->description = $request->input('description');
    $workflow->priority = $request->input('priority');
    $workflow->id_user = $request->input('id_user');


redirect('workflow');
}
Route::post('workflow/{id}','WorkflowController@AddWF');

-->

