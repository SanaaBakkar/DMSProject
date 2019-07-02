@extends('layouts.app')
@section('content')

<div class="container">

<h3>Details: {{$WorkflowSingle->description}} ({{$type1->name}})</h3>	
   <i class="list-group-item">

   	<h6>Workflow Summary</h6>
   	  <i class="list-group-item"  >
   	  	<div class="row">
   	  		<div class="col-md-4" style="border-right: 2px solid grey;">
   	  	  
		     @if(count($WorkflowSingle)>0)

			<b>General</b><hr>
			  <img src="/img/workflow.png" height="30px" >
			  <b>Statut of workflow :</b>{{ $WorkflowSingle->status}} <br>&nbsp;
			  <i style="font-size:20px" class="fa">&#xf073;</i>
			  <b>Due :</b> {{ $WorkflowSingle->due_date}}<br>&nbsp;
			  <i class="fa fa-bars"></i>
			  {{ $WorkflowSingle->priority}} priority

            </div>
            <div class="col-md-8" >
        	<b>General info</b><hr>
        	<b>Document Name :</b> {{ $WorkflowSingle->doc_name}} <br>

        	<!-- Because description case in document part is not necessary -->
        	@if( $WorkflowSingle->doc_description != 'NULL')
        	<b>Description :</b> {{ $WorkflowSingle->doc_description}}<br>
        	@endif
        	<!-- End -->
	        	<div class="row">
	        		<div class="col-md-4">
	        			<b>Started :</b> 
	        			{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $WorkflowSingle->createworkflow)->format('Y-m-d') }}
	        		</div>	        		
	        		<div class="col-md-4">
	        			<b>Started by:</b> {{$WorkflowSingle->doc_prepared_by}}
	        		</div>

	        		<div class="col-md-4">
				        <!-- display it when workflow is completed -->
			        	@if( $WorkflowSingle->status == 'Completed')
			                <b>Completed:</b> < {{$WorkflowSingle->status}} > 
			            @endif
			        	<!-- End -->
	        		</div>	        			        	
	        	</div>
					<b>Message: </b>{{$WorkflowSingle->description}}        	
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
 						<td>{{$type1->name}}</td>
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
 					</tr>

 				@foreach($WorkflowGroup as $WorkflowG)
 					<tr>
 						<td>{{$WorkflowG->assign_to}}</td>
 						<td>{{$WorkflowG->comment}}</td>
 						<td>{{$WorkflowG->status}}</td>
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
 					</tr>

 				@foreach($WorkflowParallel as $WorkflowP)
 					<tr>
 						<td>{{$WorkflowP->assign_to}}</td>
 						<td>{{$WorkflowP->comment}}</td>
 						<td>{{$WorkflowP->status}}</td>
 					</tr>
 				@endforeach
 				</thead>
 			</table> <br>
	@endif


	@if(count($WorkflowPooled)>0)
	
<b>Details Workflow:</b>
<table class="table table-sm" style="width: 80%;">
 				<thead class="thead-light" ">
 					<tr>
 						<th>Users of group</th>
 						<th>Comment</th>
 						<th>Status</th>
 					</tr>

 				@foreach($WorkflowPooled as $WorkflowPool)
 					<tr>
 						<td>{{$WorkflowPool->assign_to}}</td>
 						<td>{{$WorkflowPool->comment}}</td>
 						<td>{{$WorkflowPool->status}}</td>
 					</tr>
 				@endforeach
 				</thead>
 			</table> <br>
	@endif
     </i>
   </i>



</div>
@endsection