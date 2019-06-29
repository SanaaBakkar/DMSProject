@extends('layouts.admin')

@section('content')

<div class="container">

	<i class="list-group-item">
    	 <h3><i class="list-group-item"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp; Document Detail:</i></h3><hr>

    	<div class="row">
    		<div class="col-md-6">
    			<b>Document Name :</b> {{$document->doc_name}}
    		</div>
    		<div class="col-md-4">
    			<b>Prepared by :</b> {{$document->doc_prepared_by}}
    		</div>
    		<div class="col-md-2">
    			
    		</div>
    	</div><br>

<?php $type = App\Etypdoc::find($document->typdoc_id) ?>

    	<div class="row">
    		<div class="col-md-6">
    			<b>Document Type :</b> {{$type->typdoc_title}}
    		</div>
    		<div class="col-md-4">
    			<b>Status :</b> {{$document->doc_status}}
    		</div>
    		<div class="col-md-2">
    			
    		</div>
    	</div><br>

    	<div class="row" >
    		<div class="col-md-6">
    			<b>Created at :</b> {{$document->created_at}}
    		</div>
    		@if(!empty($document->description))
    		<div class="col-md-6">
    			<b>description :</b> {{$document->description}}
    		</div>
    		@endif
    	</div><br>

		<div class="row" >
    		<div class="col-md-4">
    			<b>Updated at :</b> {{$document->updated_at}}
    		</div>
    	 @if(!empty($document->doc_reviewed_by))
    		<div class="col-md-4">
    			<b>Reviewed by :</b> {{$document->doc_reviewed_by}}
    		</div>
    	 @endif
    	 @if(!empty($document->doc_approved_by))
    		<div class="col-md-4">
    			<b>Approved by :</b> {{$document->doc_approved_by}}
    		</div>
    	 @endif
    	</div>
    </i>

</div>
    
@endsection