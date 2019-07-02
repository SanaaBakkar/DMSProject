@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col-sm-2">
  <h6 class="dropdown-header">My tasks</h6>
  <input class="dropdown-item" type="button" id="Active" value="Active" onclick="ShowHide(this.value)">
   <input class="dropdown-item" type="button" id="Completed" value="Completed" onclick="ShowHide(this.value)">

  <div class="dropdown-divider"></div>

  
</div>



<div class="col-sm-8" id="active" style="display: inline; margin: 20px 0px 0px 30px" >
  <h4>My Tasks</h4><hr>

  <!--- Messages Info --->
    @if(!empty(Session::get('update-wf')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Worfklow Updated successfully
        </div>
      @endif

  @if(!empty(Session::get('task-done')))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Task Done successfully
        </div>
      @endif

  <h6>Active Tasks</h6>
    <div id="items" style="display: inline;">
 
        <i class="list-group-item">
            {{csrf_field()}}

    <table width="100%" name="doc_info" frame="hsides" rules="rows">
      @if (count($workflows_actives) >0)
            @foreach($workflows_actives as $workflows_active)
          <tr style="height: 90px">
            <td width="10%"><i class="fa fa-list" aria-hidden="true"></i></td>
            <td width="90%"><a href="task/{{$workflows_active->id}}" style="color: black; font-size: 17px">{{$workflows_active->description}}</a><br>
              <b>Due: </b>{{ $workflows_active->due_date}}&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
              <input type="text" name="id_doc" value="{{ $workflows_active->id_doc}}" hidden>
              <b>Started: </b>{{ $workflows_active->created_at}}<br>
              <b>Status: </b><?php if (empty($workflows_active->status)) {
                                   echo 'Not Yet Started';
                                 }else{
                                  echo $workflows_active->status;
                                 } ?><br>
 
               <b>Type:</b><?php
                                $docs = App\Edocument::find($workflows_active->id_doc);
                                $types = App\Etypdoc::find($docs->typdoc_id);
                                echo ' '.$types->typdoc_title;
                              ?><br>
               <b>Started by: </b>{{ $workflows_active->created_by}}<br>

            </td>
          </tr>
              @endforeach
              @endif


         @if (count($workflowsGroup_actives) >0)
            @foreach($workflowsGroup_actives as $workflowsGroup_active)
         <?php
                 $docs = App\Edocument::find($workflowsGroup_active->id_doc);
                 $types = App\Etypdoc::find($docs->typdoc_id);
          ?>

                @if($docs->doc_status!='Completed')
          <tr style="height: 90px">
            <td width="10%"><i class="fa fa-list" aria-hidden="true"></i></td>
            <td width="90%"><a href="taskGroup/{{$workflowsGroup_active->id}}" style="color: black; font-size: 17px">{{$workflowsGroup_active->description}}</a><br>
              <div class="row">
                <div class="col-md-6">
                  <b>Due: </b>{{ $workflowsGroup_active->due_date}}
                </div>
                <div class="col-md-6">
                    <input type="text" name="id_doc" value="{{ $workflowsGroup_active->id_doc}}" hidden>
                  <b>Started: </b>{{ $workflowsGroup_active->created_at}}<br>
                </div>                
              </div>              
              <b>Status: </b><?php if (empty($workflowsGroup_active->status)) {
                                   echo 'Not Yet Started';
                                 }else{
                                  echo $workflowsGroup_active->status;
                                 } ?><br>

               <b>Type:</b>{{$types->typdoc_title}}<br>
               <b>Started by: </b>{{ $workflowsGroup_active->created_by}}<br>

            </td>
          </tr>
          @endif
          
              @endforeach
              @endif

  @if (count($workflowsParallel_actives) >0)
       @foreach($workflowsParallel_actives as $workflowsParallel_active)
          <tr style="height: 90px">
            <td width="10%"><i class="fa fa-list" aria-hidden="true"></i></td>
            <td width="90%"><a href="taskParallel/{{$workflowsParallel_active->id}}" style="color: black; font-size: 17px">{{$workflowsParallel_active->description}}</a><br>
               <div class="row">
                <div class="col-md-6">
                  <b>Due: </b>{{ $workflowsParallel_active->due_date}}
                </div>
                <div class="col-md-6">
                    <input type="text" name="id_doc" value="{{ $workflowsParallel_active->id_doc}}" hidden>
                  <b>Started: </b>{{ $workflowsParallel_active->created_at}}<br>
                </div>                
              </div>   
              <b>Status: </b><?php if (empty($workflowsParallel_active->status)) {
                                   echo 'Not Yet Started';
                                 }else{
                                  echo $workflowsParallel_active->status;
                                 } ?><br>
 
               <b>Type:</b><?php
                                $docs = App\Edocument::find($workflowsParallel_active->id_doc);
                                $types = App\Etypdoc::find($docs->typdoc_id);
                                echo ' '.$types->typdoc_title;
                              ?><br>
               <b>Started by: </b>{{ $workflowsParallel_active->created_by}}<br>

            </td>
          </tr>
     @endforeach
@endif

  @if (count($workflowsPooled_actives) >0)
            @foreach($workflowsPooled_actives as $workflowsPooled_active)
         <?php
                 $docs = App\Edocument::find($workflowsPooled_active->id_doc);
                 $types = App\Etypdoc::find($docs->typdoc_id);
          ?>

                @if($docs->doc_status!='Completed')
          <tr style="height: 90px">
            <td width="10%"><i class="fa fa-list" aria-hidden="true"></i></td>
            <td width="90%"><a href="taskPooled/{{$workflowsPooled_active->id}}" style="color: black; font-size: 17px">{{$workflowsPooled_active->description}}</a><br>
              <div class="row">
                <div class="col-md-6">
                  <b>Due: </b>{{ $workflowsPooled_active->due_date}}
                </div>
                <div class="col-md-6">
                    <input type="text" name="id_doc" value="{{ $workflowsPooled_active->id_doc}}" hidden>
                  <b>Started: </b>{{ $workflowsPooled_active->created_at}}<br>
                </div>                
              </div>              
              <b>Status: </b>{{$workflowsPooled_active->status}}
                               <br>

               <b>Type:</b>{{$types->typdoc_title}}<br>
               <b>Started by: </b>{{ $workflowsPooled_active->created_by}}<br>

            </td>
          </tr>
          @endif
          
              @endforeach
              @endif
        </table>
        </i>
        </div>

  </div>               
 
<div class="col-sm-8" id="completed" style="display: none; margin: 20px 0px 0px 30px" >
  
  <h4>My Tasks</h4><hr>
  <h6>Completed Tasks</h6>
    <div id="items" style="display: inline;">
 
        <i class="list-group-item">
            {{csrf_field()}}

        <table width="100%" name="doc_info" frame="hsides" rules="rows">
           @if (count($workflows_completed) >0)
              @foreach($workflows_completed as $workflows_comp)

          <tr style="height: 90px">
            <td width="10%"><i class="fa fa-list" aria-hidden="true"></i></td>
            <td width="90%"><a href="CompletedTask/{{$workflows_comp->id}}" style="color: black; font-size: 17px">{{$workflows_comp->description}}</a><br>

              <div class="row">
                <div class="col-md-6">
                  <b>Due: </b>{{ $workflows_comp->due_date}}
                </div>
                <div class="col-md-6">
                    <input type="text" name="id_doc" value="{{ $workflows_comp->id_doc}}" hidden>
                  <b>Started: </b>{{ $workflows_comp->created_at}}<br>
                </div>                
              </div>   

              <b>Status: </b>{{$workflows_comp->status}}<br>
             

               <b>Type:</b><?php
                                $docs = App\Edocument::find($workflows_comp->id_doc);
                                $types = App\Etypdoc::find($docs->typdoc_id);
                                echo ' '.$types->typdoc_title;
                              ?><br>
               <b>Started by: </b>{{ $workflows_comp->created_by}}<br>

            </td>
          </tr>

              @endforeach
          @endif


        </table>
        </i>
        </div>
</div>

</div>





<script type="text/javascript">
	function ShowHide(val) {
		var nav11 = document.getElementById("active");
    var nav12 = document.getElementById("completed");

		if (val == 'Active') {
			nav11.style.display='block';
      nav12.style.display='none';
		}else if(val == 'Completed' ){
      nav11.style.display='none';
      nav12.style.display='block';
  
    }
	}


  function DisplayDoc(val) {
    var item = document.getElementById("items");
    if (val == 'Cancelled') {
      item.style.display='none';
    }
  }
</script>

@endsection
