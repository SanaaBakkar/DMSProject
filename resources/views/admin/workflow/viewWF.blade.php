@extends('layouts.admin')
@section('content')

<div class="container">

<h3>Details: {{$WorkflowSingle->description}} </h3>   
   <i class="list-group-item">
<?php $doc = App\Edocument::find($WorkflowSingle->id_doc); ?>

        <div class="row">
            <div class="col-md-4" style="border-right: 2px solid grey;">
          
             @if(count($WorkflowSingle)>0)

            <b>General</b><hr>
              <img src="/img/workflow.png" height="30px" >
              <b>Statut of workflow :</b>{{ $WorkflowSingle->status}} <br>&nbsp;
              <i style="font-size:20px" class="fa">&#xf073;</i>
              <b>Due :</b> {{ $WorkflowSingle->due_date}}<br>&nbsp;
              <i class="fa fa-bars"></i>
              {{ $WorkflowSingle->priority}} priority<br>
          
            </div>
            <div class="col-md-8" >
            <b>General info</b><hr>
            <b>Document Name :</b> {{ $doc->doc_name}} <br>


                <div class="row">
                    <div class="col-md-6">
                        <b>created by:</b> {{ $WorkflowSingle->created_by}}

                    </div>                  
                    <div class="col-md-6">
                        <b>Started at:</b> {{$WorkflowSingle->created_at}}
                    </div>
                                             
                </div>
                 <div class="row">
                    <div class="col-md-12">
                    <b>Message: </b>{{$WorkflowSingle->description}}    

                    </div>                  

                                             
                </div>
            
            </div>
        </div><br>
        
            <b>More info</b><hr>
            <b>Send Email notification:</b>
                                            @if($WorkflowSingle->mail==1)
                                                Yes
                                            @else
                                                No
                                            @endif
                <br> <br>
            <b>History :</b><hr>
            <table class="table table-sm" style="width: 80%;">
                <thead class="thead-light" ">
                    <tr>
                        <th>Type</th>
                        <th>Assign_to</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Due Date</th>
                    </tr>
                    <tr>
                        <td>{{$type->name}}</td>
                        <td>{{$WorkflowSingle->assign_to}}</td>
                        <td>{{$WorkflowSingle->comment}}</td>
                        <td>{{$WorkflowSingle->status}}</td>
                        <td>{{$WorkflowSingle->due_date}}</td>
                    </tr>
                </thead>
            </table> <br>


          @endif



    @if(count($WorkflowGroup)>0)

<b>Details Workflow:</b>
<table class="table table-sm" style="width: 80%;">
                <thead class="thead-light" ">
                    <tr>
                        <th>Users of group</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Updated at</th>
                    </tr>

                @foreach($WorkflowGroup as $WorkflowG)
                    <tr>
                        <td>{{$WorkflowG->assign_to}}</td>
                        <td>{{$WorkflowG->comment}}</td>
                        @if(!empty($WorkflowG->status))  
                        <td>{{$WorkflowG->statuss}}</td>
                      @else
                        <td>On hold</td>
                      @endif 
                        <td>{{$WorkflowG->updated_at}}</td>
                    </tr>
                @endforeach
                </thead>
            </table> <br>
    @endif
      

      @if(count($WorkflowParallel)>0)
    
<b>Details Workflow:</b>
<table class="table table-sm" style="width: 80%;">
                <thead class="thead-light" ">
                    <tr>
                        <th>Users of group</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Updated at</th>
                    </tr>

                @foreach($WorkflowParallel as $WorkflowP)
                    <tr>
                        <td>{{$WorkflowP->assign_to}}</td>
                        <td>{{$WorkflowP->comment}}</td>
                      @if(!empty($WorkflowP->status))  
                        <td>{{$WorkflowP->statuss}}</td>
                      @else
                        <td>On hold</td>
                      @endif 
                        <td>{{$WorkflowP->updated_at}}</td>
                    </tr>
                @endforeach
                </thead>
            </table> <br>
    @endif
     </i>



</div>
@endsection