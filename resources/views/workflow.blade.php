@extends('layouts.apps')
@section('content')

<div class="container">
	<div>
	    <form method="post" action="{{ url('/workflow')}}">
	          {{csrf_field()}}
	        <div class="form-group">
	          <h3><i class="list-group-item"><i class="fas fa-sitemap"></i>&nbsp;&nbsp; Start Workflow</i></h3><hr>
	        </div>
	   
	          <label><b>Workflow: </b></label>
	          <select class="form-control" name="typeWF" onChange="ShowHide(this.value)" style="width: 35%; display: inline;">
		          	<option value="Choose">Please select a workflow</option>
		          	<option value="NewTask">Assign a new Task</option>
		          	<option value="GroupReview">Review and approve (Group review)</option>
		          	<option value="SingleReview">Review and approve (Single review)</option>
	          </select>

  <!-- Modal of button Select of Assignee -->	          
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
        	    <div class="col-sm-6">
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

				        			<td align="right"><input type="checkbox" value ="{{$listUser->id}}" name="id_user"  ></input></td>
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

	    <!-- Assign a new Task Option-->    
	        <div id="1" class="form-group" style="display: none;">
	          <i class="list-group-item">

	          	Description:<br>
	          	 <textarea style="width: 80%; height: 20%" name="description" ></textarea><br><br>

	          	<div class="row">
                    <div class="col">
    		          	 <label for="start"><i style="font-size:24px" class="fa">&#xf073;&nbsp;</i>Due:</label>
    		          	   <input type="date" class="form-control" id="due" name="Date" placeholder="MM-DD-YY" style="width: 35%">
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
				Assign to: 
				<button type="button" name="id_user" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="display: inline;">Select</button><br><br>
				
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

						<b>Other Options:</b>
				<input type="checkbox" name="email">Send email
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
     var typewf2 = document.getElementById("2");

		if (val == 'NewTask') {
			typewf1.style.display = 'block';
			typewf2.style.display = 'none';

		}else if (val == 'GroupReview') {
			typewf1.style.display = 'none';
			typewf2.style.display = 'block';
		}
		else{
			typewf1.style.display = 'none';
			typewf2.style.display = 'none';
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
