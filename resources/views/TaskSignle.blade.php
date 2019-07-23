@extends('layouts.app')
@section('content')
<div class="container">
	
    <div class="form-group" style="width: 80%, margin">
                <h3><i class="list-group-item"><i class="fas fa-sitemap"></i>&nbsp;&nbsp; Edit Task:</i></h3><hr>
    </div>

 @if(count($workflow) >0)
    <form method="post" action="{{ url('/task',array($workflow->id)) }}">
      	          {{csrf_field()}}

        <input type="text" name="ID_doc" value="{{$workflow->id_doc}}" hidden/>

        <i class="list-group-item">
        <table width="100%" >
        	<tr>
        	    <td colspan="3"><b>Info</b><hr></td>
            </tr>
            <tr>
        	    <td colspan="3"><b>Message: </b> {{ $workflow->description}}</td>
            </tr>
            <tr>
        	   <td width="33%"><b>Owner: </b> {{ $workflow->created_by}}</td>
        	   <td width="33%"><b>Priority: </b> {{ $workflow->priority}}</td>
        	   <td width="33%"><b>Due: </b> {{ $workflow->due_date}}</td>
            </tr>
            <tr>
        	    <td colspan="3"><br><b>Progress</b><hr></td>
            </tr>
            <tr>
        	    <td><b>Status:*</b>
        	    <select name="status" class="browser-default custom-select" style="width: 50%; display: inline;" required>
        					    <option value="In progress">In progress</option>
                                <option value="On hold">On hold</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Completed">Completed</option>
        	    </select> </td>
            </tr>
            <tr>
        	    <td colspan="3" ><br><b>Items</b><hr></td>
            </tr>
           
              <?php $docs = App\Edocument::find($workflow->id_doc);?> 
            <tr>
            	<td colspan="3"> <div class="row">
        			  <div class="col-sm-1"><img height="50px" src="/img/fileicon.png" /></div>
        			  <div class="col-sm-6"><b> {{$docs->doc_name}}</b><br>
        			              Description :  {{$docs->doc_description}}<br>
        			              Modified on : {{$docs->updated_at}}</div>
        			  <div class="col-sm-3"><a href="/visualize/{{$docs->id}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                            View document</a></div>
        			 			</div></td>
            </tr>

            <tr>
        	    <td colspan="3" ><br><b>Response</b><hr></td>
            </tr>
            
            <tr>
            	
            	<td colspan="3"><b>Comment:</b> <bR><textarea name="comment" class="form-control" ></textarea></td>
            </tr>
        </table>
            <button type="submit" class="btn btn-primary" name="btn-Save">Save</button>

        </i>
    </form>
    @endif


 

 
</div>


@endsection