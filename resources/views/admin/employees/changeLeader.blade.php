@extends('layouts.admin')

@section('content')

<a href="{{ route('employees.index')}}" class="btn btn-danger">Revert deleting & go back</a>


@if ($siblingsNumber<1)
    <h1>The current mployee {{ $leader->first_name.' '.$leader->middle_name.' '.$leader->last_name }} #{{ $leader->id}}</h1>
    <p class="text-red">doesnot have siblings, that's why it is impossible to be deleted! </p>
    <p>Please return back!</p>
    
@else
    <h2>Hallo this is Change Leader form</h2>
    <h3>The curren Leader, that You want to delete is: {{ $leader->first_name.' '.$leader->middle_name.' '.$leader->last_name }}</h3>
    <p>He has a position: {{ $leader->position_id }}</p>
    <p>But before deletion of the leader, You should pick up another Leader!</p>
    <p>You can choose among {{ $siblingsNumber }} other colleges on the given position</p>
    <div class="form-group">
        <label for="leaderId">Select another Leader</label>
        <input type="hidden"  id="positionId" value="{{ old('leaderId')?? $leader->position_id }}" >
        <input type="hidden" name="employeeId" id="employeeId" value="{{ old('employeeId')?? $leader->id }}" > 
        <select name="leaderId" id="anotherLeaderIdSelect" class="form-control <?= $errors->has('leaderId')? 'is-invalid' : '' ?> select2" ></select>
        <div class="invalid-feedback"><?= $errors->first('leaderId') ?></div>
    </div>

    <h2>It is a list of {{ count($subOrdinates)}} employees, that should changeLeader</h2>
    @foreach( $subOrdinates as $subOrdinate)
        {{ $subOrdinate->first_name.' '.$subOrdinate->middle_name.' '.$subOrdinate->last_name }} <br>

    @endforeach

  @endif
@endsection