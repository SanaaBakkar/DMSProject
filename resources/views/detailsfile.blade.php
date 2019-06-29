@extends('layouts.app')
@section('content')


<div class="container">
    <div >
      <form method="post" action="{{ url('/edit')}}">
          {{csrf_field()}}
        <div class="form-group">
          <h3><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{$documents->doc_name}}</h3>
          <p>Created by {{$documents->doc_prepared_by}} on {{$documents->created_at}}.</p>
          <p>{{$documents->doc_description}}.
                      </div>
    <input type="text" name="doc_name" value="{{$documents->doc_name}}" hidden="true"> 
      </form>
    </div> 
  

<?php   $file=public_path().'/files/'.$documents->doc_name; ?>
 <!--echo "<br><br>Contenu du fichier $file : "; ?>
                  <iframe src="files/double.jpg" width="80%" height="80%" marginwidth=0 marginheight=0 hspace=0 vspace=0 scrolling="no" >
                  </iframe>-->

  </div>
  <table align="right" width=20%>
  	<tr>
  	  	<td ><a class="list-group-item" href="<?php public_path(); ?>/files/{{$documents->doc_name}}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Download document</a> </td> 
  	</tr>
  	<tr>
      	<td ><a class="list-group-item" href="/update/{{$documents->id}}"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit Proprieties</a> </td> 	
  	</tr>
    <tr>
        <td ><a class="list-group-item" href="/visualize/{{$documents->id}}"><i class="far fa-edit"></i>&nbsp;&nbsp;View doc </a> </td>   
    </tr>
    <tr>
      @if($documents->doc_status=='Not yet started')
	     <td ><a class="list-group-item" href="/workflow/{{$documents->id}}"><i class="fas fa-sitemap"></i>&nbsp;&nbsp;Start workflow</a> </td> 
       @else
       <td ><a class="list-group-item" href="/viewworkflow/{{$documents->id}}"><i class="fas fa-sitemap"></i>&nbsp;&nbsp;View workflow</a> </td> 
       @endif

	   </tr>
</table>  

<iframe src="/visualize/{{$documents->id}}" width="900px" height="600px"></iframe>
 


@endsection
