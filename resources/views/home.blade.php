@extends('layouts.app')

@section('content')
<div class="container" style="">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    For more details please check our documentation.
                   <a href="#" class="btn btn-primary ">Get Started</a>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 30px; font-size: 13px">
      <div class="col">
          <div class="card bg-light mb-3" style="max-width: 60rem; height: 280px; margin-left: 12px; overflow-y: auto">
              <div class="card-header">
                     <ul class="nav nav-tabs card-header-tabs">
                         <li class="nav-item"><a class="nav-link active" onclick="ShowActive();">Active Tasks</a></li>
                
                         <li class="nav-item"><a class="nav-link" onclick="ShowCompleted();">Completed Tasks</a></li>
                    </ul>
              </div>

              <div class="card-body">
                  <div id="active" style="display: inline;">
                      @if (count($workflows_active) >0)

                      @foreach($workflows_active as $workflow_active)
                      <p class="card-text" style="font-size: 11px"><a href="task/{{$workflow_active->id}}" style="color: black; font-size: 17px"><b>
                          {{$workflow_active->description}}</b></a><br>Due: {{$workflow_active->due_date}}<br>
                                 <?php if (empty($workflow_active->status)) {
                                   echo 'Not Yet Started';
                                 }else{
                                  echo $workflow_active->status;
                                 } ?> <br>
                          {{$workflow_active->comment}}</p><hr>
                      @endforeach

                      @endif


                  @if (count($workflowsGroup_active) >0)

                    @foreach($workflowsGroup_active as $workflowGroup_active)
 
                   <?php
                 $docs = App\Edocument::find($workflowGroup_active->id_doc);
                   ?>

                      @if($docs->doc_status!='Completed')
                            <p class="card-text" style="font-size: 11px"><a href="taskGroup/{{$workflowGroup_active->id}}" style="color: black; font-size: 17px"><b>
                                {{$workflowGroup_active->description}}</b></a><br>Due: {{$workflowGroup_active->due_date}}<br>
                                       <?php if (empty($workflowGroup_active->status)) {
                                         echo 'Not Yet Started';
                                       }else{
                                        echo $workflowGroup_active->status;
                                       } ?> <br>
                               </p><hr>
                     @endif         
                    @endforeach

                  @endif


                 @if (count($workflowsParallel_active) >0)

                    @foreach($workflowsParallel_active as $workflowParallel_active)
 
                   <?php
                 $docs = App\Edocument::find($workflowParallel_active->id_doc);
                   ?>

                      @if($docs->doc_status!='Completed')
                            <p class="card-text" style="font-size: 11px"><a href="taskParallel/{{$workflowParallel_active->id}}" style="color: black; font-size: 17px"><b>
                                {{$workflowParallel_active->description}}</b></a><br>Due: {{$workflowParallel_active->due_date}}<br>
                                       <?php if (empty($workflowParallel_active->status)) {
                                         echo 'Not Yet Started';
                                       }else{
                                        echo $workflowParallel_active->status;
                                       } ?> <br>
                               </p><hr>
                     @endif         
                    @endforeach

                  @endif

                @if (count($workflowsPooled_actives) >0)

                    @foreach($workflowsPooled_actives as $workflowPooled_active)
 
                   <?php
                 $docs = App\Edocument::find($workflowPooled_active->id_doc);
                   ?>

                      @if($docs->doc_status!='Completed')
                            <p class="card-text" style="font-size: 11px"><a href="taskPooled/{{$workflowPooled_active->id}}" style="color: black; font-size: 17px"><b>
                                {{$workflowPooled_active->description}}</b></a><br>Due: {{$workflowPooled_active->due_date}}<br>
                                       <?php if (empty($workflowPooled_active->status)) {
                                         echo 'Not Yet Started';
                                       }else{
                                        echo $workflowPooled_active->status;
                                       } ?> <br>
                               </p><hr>
                     @endif         
                    @endforeach

                  @endif
                  </div>   
                  <div id="completed" style="display: none;">
                   @if (count($workflows_completed) >0)

                      @foreach($workflows_completed as $workflow_completed)
                      <?php
                 $docs = App\Edocument::find($workflow_completed->id_doc);
                   ?>
                @if($docs->doc_status=='Completed')   
                      <p class="card-text" style="font-size: 11px"><a href="CompletedTask/{{$workflow_completed->id}}" style="color: black; font-size: 17px"><b>
                          {{$workflow_completed->description}}</b></a><br>Due: {{$workflow_completed->due_date}}<br>
                          {{$workflow_completed->status}}<br>
                          {{$workflow_completed->comment}}</p><hr>
                @endif          
                      @endforeach

                      @endif
                  </div>    
              </div>
          </div>
      </div>

      <div class="col" style="line-height: 10px; ">
           <div class="card bg-light mb-3" style="max-width: 60rem; height: 280px; margin-right: 12px; overflow-y: auto">
                <div class="card-header" style="height: 40px">
                        <h5>My Documents</h5>
                </div>
                <div class="card-body">
                  @if (count($documents) >0)

                  @foreach($documents as $document)
                    <?php  ?>
                    <p class="card-text"><a href="detail/{{$document->id}}" style="color: black; font-size: 17px">{{$document->doc_name}}</a></p>
                    <p style="font-size: 11px"> 
                    <?php
                            $today = new DateTime();
                            $date_created  = new DateTime($document->created_at);
                            $days = $date_created->diff($today);
                            echo $days->format('Created %a days ago');  ?><hr></p>
                    @endforeach

                    @endif


                   
                   

                </div>
            </div>
      </div>
</div>



</div>

<script type="text/javascript">
  function ShowCompleted(val) {
    var comp_items = document.getElementById('completed');
    var act_items = document.getElementById('active');

   comp_items.style.display='inline';
    act_items.style.display='none';

  }
  function ShowActive() {
    var comp_items = document.getElementById('completed');
    var act_items = document.getElementById('active');
       act_items.style.display='inline';
       comp_items.style.display='none';

  }
</script>
@endsection
