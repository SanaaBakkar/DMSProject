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


  </div>
</div>
<script type="text/javascript">
	
/***** Display each type of workflow *****/
 function ShowHide(val) {

    if (val == '1') {
     window.location.href  = '{{url("workflow/{$documents->id}")}}';

    }else if (val == '2') {
      window.location.href = '{{url("workflowGroup/{$documents->id}")}}';
    
    }else if (val == '3') {
      window.location.href = '{{url("workflowParallel/{$documents->id}")}}';
    }else if (val == '4') {
      window.location.href = '{{url("workflowPooled/{$documents->id}")}}';
    }

  }
</script>
@endsection