@extends('layouts.admin')

@section('content')
<div class="text-center mb-3">
    <a href="{{ route('employees.index')}}" class="btn btn-danger">Revert deleting & go back</a>
</div>

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

    <form action="{{route('employees.leader.change')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="leaderId">Select another Leader</label>
            <input type="hidden"  id="positionId" value="{{ old('leaderId')?? $leader->position_id }}" >
            <input type="hidden" name="oldLeaderId" id="oldLeaderId" value="{{ old('oldLeaderId')?? $leader->id }}" > 
            <select name="leaderId" id="anotherLeaderIdSelect" class="form-control <?= $errors->has('leaderId')? 'is-invalid' : '' ?> select2" ></select>
            <div class="invalid-feedback"><?= $errors->first('leaderId') ?></div>
        </div>

        <h2>There are {{ count($subOrdinates)}} employees, that should change their Leader</h2>
       

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-info" > Reorder subordinates and delete curent Leader</button>
        </div>
    </form>
  @endif
@endsection