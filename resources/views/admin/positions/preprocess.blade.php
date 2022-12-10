@extends('layouts.admin')

@section('content')

<div class="text-center mb-3">
    <a href="{{ route('positions.index')}}" class="btn btn-danger">Revert deleting & go back</a>
</div>

<h2 class="text-center"> Deleting Position#{{ request('id') }} </h2>
<h3 class="text-center"><small class="text-red">Title </small>{{ $position->title }}</h3>
<h4 class="text-center"><small class="text-red">Description </small>{{ $position->description }} </h4>

@if(request('employees'))
<section>
<h3>The current Position contains {{ $employeesNumber }} employee(s)</h3>
<p>Before deletion of the position you should resubordinate them</p>

<form method="POST" action="{{ route('positions.employees.resubordinate') }}" >
    @CSRF
    <input type="hidden" name="id" value="{{ $position->id }}" />
    <div class="form-group">
    <label for="siblingsPosition">Choose another position</label>
    <select class="form-control <?= $errors->has('siblingsPosition')? 'is-invalid' : '' ?>"
    id="siblingsPosition"  name="siblingsPosition">
    <option>Choose position</option>
    @foreach  ($siblingsPositions as $position)
    <option
        {{-- <option {{ $siblingsPosition == $level ? "selected" : "" }} --}}
        value= "{{ $position->id }}" >{{ $position->title }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback"><?= $errors->first('siblingsPosition') ?></div>

    <div class="text-center mb-3">
        <button type="submit" class="btn btn-primary mb-2 mt-4">Resubordinate employees and delete current position</button> 
    </div>
</form>
</section>
@endif

@if(request('subpositions'))
<section>
    <h3>The current Position contains {{ $subPositionsNumber }} subposition(s)</h3>
    <p>Before deletion of the position you should resubordinate them</p>
    
    <form method="POST" action="{{ route('positions.siblings.change') }}">
        @CSRF
        <input type="hidden" name="id" value="{{ $position->id }}" />
        <label for="siblingsPosition">Change for another siblings position</label>
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
            <button type="submit" class="btn btn-primary mb-2 mt-4">Choose sibling position and delete the current one</button> 
        </div>
    </form>

</section>
@endif


@endsection