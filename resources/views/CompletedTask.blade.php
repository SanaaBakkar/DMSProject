@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-group" style="width: 80%, margin">
                <h3><i class="list-group-item"><i class="fas fa-sitemap"></i>&nbsp;&nbsp; Detail Task:</i></h3><hr>
    </div>

 @if(count($Workflow) >0)
      <form method="post" action="{{ url('/CompletedTask',array($Workflow->id)) }}">
      	          {{csrf_field()}}

        <input type="text" name="ID_doc" value="{{$Workflow->id_doc}}" hidden/>

        <i class="list-group-item">
        <table width="100%" >
        	<tr>
        	    <td colspan="3"><b>Info</b><hr></td>
            </tr>
            <tr>
        	    <td colspan="3"><b>Message: </b> {{ $Workflow->description}}</td>
            </tr>
            <tr>
        	   <td width="33%"><b>Owner: </b> {{ $Workflow->created_by}}</td>
        	   <td width="33%"><b>Priority: </b> {{ $Workflow->priority}}</td>
        	   <td width="33%"><b>Due: </b> {{ $Workflow->due_date}}</td>
            </tr>           
            <tr>
        	    <td colspan="3"><br><b>Current Task</b><hr></td>
            </tr>

          	<?php
          	    $docs = App\Edocument::find($Workflow->id_doc);
          	    $type = App\Wftype::find($Workflow->id_type);
          	?> 
            <tr>
            	<table class="table table-sm" style="width: 50%;">
            		<thead class="thead-light">
	            		<tr>
	            			<th>Type</th>
	            			<th>Assigned to</th>
	            			<th>Completed by</th>
	            		</tr>	
            		</thead>
            		<tbody>
	            		<tr>            		
			            	<td>{{ $type->name}}</td>
			            	<td>{{ $Workflow->assign_to}}</td>
			            	<td>{{ $docs->doc_approved_by}}</td>
	            		</tr>	
            		</tbody>
            		
 
            	</table>
            </tr>
            
            <tr>
        	    <td colspan="3" ><br><b>Items</b><hr></td>
            </tr>
           
            <tr>
            	<td colspan="3"> <div class="row">
        			  <div class="col-sm-1"><img height="50px" src="/img/fileicon.png" /></div>
        			  <div class="col-sm-6"><b> {{$docs->doc_name}}</b><br>
        			              Description :  {{$docs->doc_description}}<br>
        			              Modified on : {{$docs->updated_at}}</div>
        			 			</div></td>
            </tr>     
        </table><br>
     <center><input type="submit" class="btn btn-primary" name="btn-Save" value="Task Done"></center>
        </i>
    </form>
    @endif


</div>
@endsection