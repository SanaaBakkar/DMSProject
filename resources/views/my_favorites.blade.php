@extends('layouts.apps')

@section('content')

<div class="container">
	<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" style="margin: 0px 0px 0px 30px">
          <thead>
            <tr>
              <th>
              	<h4>All My Favorites</h4>
              </th>
            </tr>
          </thead>
          <tbody>

           @foreach($favorites as $favorite)
               <?php $document = App\Edocument::find($favorite->document_id); ?>

            <tr>
              <td>
                <div class="row">
                  <div class="col-2">
                    <a href="detail/{{$document->id}}"><img src="/img/document.png" style="width: 50%"></a>
                  </div>

                  <div class="col-10">
                    <a href="detail/{{$document->id}}" target="_blank"> {{$document->doc_name}}</a><br> 

                   Created at <?php $date = Carbon\Carbon::parse($doc->created_at);
                     echo $date->toFormattedDateString(); ?><br>

                      {{$document->doc_description}}<br>

                    <!-- Button UnFavorite-->                      
                  <a href="/unfavorite/{{$document->id}}" class="text-dark" title="unfavorite_doc" id="unfavorite" ><i class="fa fa-heart" id="unfavorite" style="color:red"></i> Unfavorite</i></a>&nbsp;&nbsp;

                  </div>
                </div>       
              </td>
            </tr>
              @endforeach
         </table>
</div>


@endsection