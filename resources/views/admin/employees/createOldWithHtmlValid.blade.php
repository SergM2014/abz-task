@extends('layouts.admin')

@section('content')

<h2> Create new Employee </h2>

<form class="m-3">
  <div class="form-group" method="post" action=" {{ route('employees.store') }}>
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name"
    minlength="2" maxlength="256" required >
  </div>
  <div class="form-group">
    <label for="middleName">Middle Name</label>
    <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Middle Name"
    minlength="2" maxlength="256" >
  </div>
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name"
    minlength="2" maxlength="256" required  >
  </div>
  
  <div class="form-group">
    <label for="positionId">Position select</label>
    <select class="form-control" id="positionId" reqired>
      @foreach  ($positions as $position)
      <option value= "{{ $position->id }}" >{{ $position->title }}</option>
      @endforeach
  
    </select>
  </div>
  <div class="form-group">
    <label for="leaderId">Leader select</label>
    <select name="leaderId" id="leaderIdSelect" class="form-control select2" required></select>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <div class="text-red">
    <smal>Put phone only in following formats: +38(066)1234567 +38(0661)123456 +38(06612)12345 1234567</smal>
    </div>
    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone"
     pattern="([\+]\d{2}[\(]\d{3}[\)]\d{7})|([\+]\d{2}[\(]\d{4}[\)]\d{6})|([\+]\d{2}[\(]\d{5}[\)]\d{5})|\d{10}"
     required >
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="email"
     required  >
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <div class="text-red">
    <smal>if sum is decimal, use  delimeter -comma, after comma 3 numbers are allowed. the max sum is 500,000 </smal>
    </div>
    <input type="number" class="form-control" name="salary" id="salary" placeholder="Salary" 
    step="0.001" min="0" max="500" >
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>

  <button type="submit" class="btn btn-primary mb-2">Update User</button>
</form>

  @endsection