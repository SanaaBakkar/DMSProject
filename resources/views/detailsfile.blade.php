@extends('layouts.apps')
@section('content')


<div class="container">

  <form method="post" action="{{ url('/edit')}}">
          {{csrf_field()}}
      <div class="form-group">
        <h3><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{$documents->doc_name}}</h3>
        <p>Created by {{$documents->doc_prepared_by}} on {{$documents->created_at}}.</p>
        <p>{{$documents->doc_description}}.</p>
      </div>
    <input type="text" name="doc_name" value="{{$documents->doc_name}}" hidden="true"> 
 
<?php   $file=Storage::disk('public')->path('public/files/'.$documents->doc_name); ?>


  <table align="right" width=20%>
  
  	<tr>
      	<td ><a class="list-group-item" href="/update/{{$documents->id}}" id="edit_doc"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit Proprieties</a> </td> 	
  	</tr>
    <tr>
        <td ><a class="list-group-item" href="/visualize/{{$documents->id}}"><i class="far fa-edit"></i>&nbsp;&nbsp;View doc </a> </td>   
    </tr>
    <tr>
      @if($documents->doc_status=='Not yet started')
	     <td ><a class="list-group-item" href="/workflow/{{$documents->id}}"><i class="fas fa-sitemap" id="start_wf"></i>&nbsp;&nbsp;Start workflow</a> </td> 
      @else
       <td ><a class="list-group-item" href="/viewworkflow/{{$documents->id}}"><i class="fas fa-sitemap"></i>&nbsp;&nbsp;View workflow</a> </td> 
      @endif

	  </tr>
  </table>  

  <iframe src="/visualize/{{$documents->id}}" width="850px" height="600px" ></iframe>


</form>
</div>

@endsection
