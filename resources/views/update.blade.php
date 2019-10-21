@extends('layouts.app')
@section('content')

<div class="container">
    <div >
<h3 class="well"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit document </h3><hr>
      <i class="list-group-item">
      <form method="post" action="{{ url('/edit',array($documents->id)) }}">
          {{csrf_field()}}
        <div class="form-group">
            <label >Title</label>
            <input type="text" class="form-control" style="width: 50%" value="{{ $documents->doc_name }}" name="doc_name" readonly />
            </div>
             <div class="form-group">
              <label >Description:</label><br>
                  <?php if ($documents->doc_description=='No description') {?> 
                        <textarea style="width: 50%; height: 20%" name="description" ></textarea>
                    <?php }else {?>
                        <textarea style="width: 50%; height: 20%" name="description" value="{{ $documents->doc_description }}" >{{ $documents->doc_description }}</textarea>
                  <?php } ?>
          </div>
              <div class="form-group">
              <label >Status</label>
              <select name="status" class="form-control" style="width: 20%">
              	<option value="Not yet started"> Choose a status </option>
              	<option value="In progress"> In progress </option>
              	<option value="Cancelled"> Cancelled </option>
              	<option value="Completed"> Completed </option>
              </select>
          </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
      </form>
    </i>
    </div> 
  </div>
@endsection