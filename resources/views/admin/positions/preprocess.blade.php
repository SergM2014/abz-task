@extends('layouts.admin')

@section('content')



{{ $route}}
{{ $submitBtnTitle }}
{{ $selectTitle }}
{{ $disclaimer }}

<div class="text-center mb-3">
    <a href="{{ route('positions.index')}}" class="btn btn-danger">Revert deleting & go back</a>
</div>

<h2 class="text-center"> Deleting Position#{{ request('id') }} </h2>
<h3 class="text-center"><small class="text-red">Title </small>{{ $position->title }}</h3>
<h4 class="text-center"><small class="text-red">Description </small>{{ $position->description }} </h4>

<section>
    <h3>{{ $disclaimer }}</h3>
    <p>Before deletion of the position you should resubordinate them</p>
    
    <form method="POST" action="{{ $route }}">
        @CSRF
        <input type="hidden" name="id" value="{{ $position->id }}" />
        <label for="siblingsPosition">{{ $selectTitle }}</label>
        <select class="form-control <?= $errors->has('siblingsPosition')? 'is-invalid' : '' ?>"
        id="siblingsPosition"  name="siblingsPosition">
        <option>Choose position</option>
        @foreach  ($siblingsPositions as $position)
        <option
           
            value= "{{ $position->id }}" >{{ $position->title }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback"><?= $errors->first('siblingsPosition') ?></div>

        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary mb-2 mt-4">{{ $submitBtnTitle }}</button> 
        </div>
    </form>

</section>


@endsection