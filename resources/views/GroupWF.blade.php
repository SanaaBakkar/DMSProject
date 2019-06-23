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

            <label><b>Workflow: </b></label>
            <select class="form-control" name="typeWF" onChange="ShowHide(this.value)" style="width: 35%; display: inline;">
                <option value="Choose">Please select a workflow</option>
                              <?php foreach ($wftypes as $wftype): ?>
                <option value="{{$wftype->id}}">{{$wftype->name}}</option>
                              <?php endforeach; ?>
            </select>

  <!---------------------Group Part ------------------------>
      <!-- Modal of button Select of a groupe Assignee --> 
 <form method="post" action="{{ url('/workflowG',array($documents->id)) }}">
            {{csrf_field()}}


   <div class="container">
  <div class="modal fade" id="myModalGroup" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Groups list</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-sm-6">
              <div style="overflow: scroll; height: 290px;">

                <table class="table table-sm" width="80%" border="0" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr class="table-secondary">
                      <th colspan="2"><center>Name</center></th>
                      </tr>
                  </thead>
                            <?php foreach ($listGroups as $listGroup):?>
                    <tr>
                      <td align="left" class="subtitle_3">{{$listGroup->name}}</td>

                      <td align="right"><input type="checkbox" name="id_group" value ="{{$listGroup->id}}" ></input></td>
                    </tr>
                            <?php  endforeach; ?>
                </table>  
            </div>
            </div>  
              <div class="col-sm-3">

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

        <!-- Review and approve (Group review) -->     
           <div id="2" class="form-group" style="display: block;">
            <i class="list-group-item">
              <label><b>Review and approve (Group review):</b></label><br>

              <input type="text" name="type_Workflow" value="2" hidden>

              Description:<br>
               <textarea style="width: 80%; height: 20%" name="description" ></textarea><br><br>

              <div class="row">
                    <div class="col">
                     <label for="start"><i style="font-size:24px" class="fa">&#xf073;&nbsp;</i>Due:</label>
                       <input type="date" class="form-control" id="Date" name="Date" placeholder="MM-DD-YY" style="width: 35%">
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
        Review Group:*    
        <input type="button" name="id_group" class="btn btn-info" data-toggle="modal" data-target="#myModalGroup" value="Select" required><br><br>
        
        Required approval Percentage*:

        <input type="number" class="form-control" name="percentage" style="width: 15%; display: inline-block;" min="1" max="100" value="50" >
        <span class="help-icon">
          <img src="/img/interro.png" height="20px" title="This field must have a value between 1 and 100.">
        </span><br><br>

        <b>Document</b>
        <div id="doc" style="display: block;">
        <i class="list-group-item">
        <table>
          <tr>
             <td width="20%"><img height="50px" src="/img/fileicon.png" /></td>
            <td width="60%">{{$documents->doc_name}} <br>
              Description : {{ $documents->doc_description }}<br>
              Modified on : {{ $documents->updated_at}}</td>
          </tr>
        </table>
        </i>
          </div>
          
         <!-- <div id="removedoc" style="display: none;">
            <select class="form-control" disabled> <option >No items selected</option></select>
          </div>

        <button type="button" class="btn btn-info" style="display: inline;" value="add" onclick="Show(this.value)" >Add</button>
        <button type="button" class="btn btn-danger" style="display: inline;" value="remove" onclick="Show(this.value)" >Remove</button><br><br> -->

        <b>Other Options:</b>
        <input type="checkbox" name="email">Send email
      </i><br>

      <input type="submit" class="btn btn-info" name="group_button" value="Start workflow">
          <input type="reset" class="btn btn-danger" name="cancel" value="Cancel">
          </div>
        
</form>
    <!-- End -->  
    </div>
  </div>
<script type="text/javascript">
  /***** Display each type of workflow *****/
  function ShowHide(val) {

     var typewf2 = document.getElementById("2");

    if (val == '1') { 

     window.location.href = '{{url("workflow/{$documents->id}")}}';

    }else if (val == '2') {
        typewf2.style.display='block';   
        
    } else if (val=='3'){
     window.location.href = '{{url("workflowParallel/{$documents->id}")}}';
    }
  }

</script>
    @endsection