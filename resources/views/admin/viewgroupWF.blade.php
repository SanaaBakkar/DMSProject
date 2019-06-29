@extends('layouts.admin')

@section('content')

<div class="container">

	<i class="list-group-item">
    	 <h3><i class="list-group-item"><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp; Worfklow Detail:</i></h3><hr>
         <h5>Info general</h5><hr>
<?php $doc = App\Edocument::find($workflow->id_doc); ?>


    	<div class="row">
    		<div class="col-md-6">
    			<b>Document Name :</b> {{$doc->doc_name}}
    		</div>
    		<div class="col-md-6">
    			<b>Workflow description :</b> {{$workflow->description}}
    		</div>
    	</div><br>

    	<div class="row">
    		<div class="col-md-6">
    			<b>due date :</b> {{$workflow->due_date}}
    		</div>
    		<div class="col-md-4">
    			<b>Priority :</b> {{$workflow->priority}}
    		</div>
            @if(!empty($workflow->status))
            <div class="col-md-2">
                <b>Status :</b> {{$workflow->status}}
            </div>
            @endif
    		
    	</div><br>

    	<div class="row" >
    		<div class="col-md-4">
    			<b>Created by :</b> {{$workflow->created_by}}
    		</div>
    		<div class="col-md-4">
    			<b>assign to :</b> {{$workflow->assign_to}}
    		</div>
            <div class="col-md-4">
                <b>Created at :</b> {{$workflow->created_at}}
            </div>
    	</div><br>

		<div class="row" >
    		<div class="col-md-4">
    			<b>Due date :</b> {{$workflow->due_date}}
    		</div>
            <div class="col-md-4">
            	 @if($workflow->mail==1)
            			<b>Send Mail :</b> Yes
                 @else
                        <b>Send Mail :</b> No
                 @endif
        	</div>
    		<div class="col-md-4">
    			<b>Updated at :</b> {{$workflow->updated_at}}
    		</div>
    	</div>
    </i>

</div>
    
@endsection