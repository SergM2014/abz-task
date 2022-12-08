@extends('layouts.admin')

@section('content')

<h2> Create new Position </h2>

<form class="m-3" method="post" action="{{ route('positions.store') }}">
  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="form-group">
  <label for="subordinaryLevel">Position select</label>
  <select class="form-control <?= $errors->has('subordinaryLevel')? 'is-invalid' : '' ?>"
   id="subordinaryLevel"  name="subordinaryLevel">
   @foreach  ($positions as $position)
    <option {{ old('subordinaryLevel') == $position->subordinary_level ? "selected" : "" }}
       value= "{{ $position->subordinary_level }}" >{{ $position->subordinary_level }}</option>
    @endforeach
  </select>
  <div class="invalid-feedback"><?= $errors->first('subordinaryLevel') ?></div>
</div>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control <?= $errors->has('title')? 'is-invalid' : '' ?>" 
    name="title" id="title" value="{{ old('title') }}" placeholder="title"
   >
   <div class="invalid-feedback"><?= $errors->first('title') ?></div>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control <?= $errors->has('description')? 'is-invalid' : '' ?>" 
      id="description" rows="3">{{ old('description') }}</textarea>
    <div class="invalid-feedback"><?= $errors->first('description') ?></div>
  </div>
  
  <div class="form-group">
    <label for="parentId">Supreme position select</label>
    <input type="hidden"  id="parentId" value="{{ old('parentId') }}" >
    <select name="parentId" id="parentIdSelect" class="form-control <?= $errors->has('parentId')? 'is-invalid' : '' ?> select2" ></select>
    <div class="invalid-feedback"><?= $errors->first('parentId') ?></div>
  </div>
 
  <div class="text-center">
    <button type="submit" class="btn btn-primary mb-2 btn-lg">Create a new User</button>
  </div>
</form>                   
                

  @endsection