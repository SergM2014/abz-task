@extends('layouts.admin')

@section('content')

<h2> Update Position#{{ $position->id }} </h2>

<form class="m-3" method="post" action="{{ route('positions.update', ['position' => $position->id]) }}">
  @method('PUT')
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="form-group">
  <label for="subordinaryLevel">Subordinary level select</label>
  <select class="form-control <?= $errors->has('subordinaryLevel')? 'is-invalid' : '' ?>"
   id="subordinaryLevel"  name="subordinaryLevel">
   @foreach  ($subordinaryLevels as $level)
    <option {{ $subordinaryLevel == $level ? "selected" : "" }}
       value= "{{ $level }}" >{{ $level }}</option>
    @endforeach
  </select>
  <div class="invalid-feedback"><?= $errors->first('subordinaryLevel') ?></div>
</div>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control <?= $errors->has('title')? 'is-invalid' : '' ?>" 
    name="title" id="title" value="{{ Arr::has(old(), 'title')? old('title') : $position->title }}" placeholder="title"
   >
   <div class="invalid-feedback"><?= $errors->first('title') ?></div>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control <?= $errors->has('description')? 'is-invalid' : '' ?>" 
      id="description" name="description" rows="3">{{ Arr::has(old(), 'description')? old('description') : $position->description }}</textarea>
    <div class="invalid-feedback"><?= $errors->first('description') ?></div>
  </div>
  
  <div class="form-group">
    <label for="supremePositionIdSelect">Supreme position select</label>
    <input type="hidden"  id="supremePositionId" value="{{ $supremePositionIdSelect }}" >
    <select name="supremePositionIdSelect" id="supremePositionIdSelect" class="form-control <?= $errors->has('supremePositionIdSelect')? 'is-invalid' : '' ?> select2" ></select>
    <div class="invalid-feedback"><?= $errors->first('supremePositionIdSelect') ?></div>
  </div>
 
  <div class="text-center">
    <button type="submit" class="btn btn-primary mb-2 btn-lg">Update Position</button>
  </div>
</form>                   
                

  @endsection