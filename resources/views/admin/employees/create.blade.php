@extends('layouts.admin')

@section('content')

<h2> Create new Employee </h2>

<form class="m-3">
  <div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name"
    >
  </div>
  <div class="form-group">
    <label for="middleName">Middle Name</label>
    <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Middle Name"
    >
  </div>
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name"
    >
  </div>
  <div class="form-group">
    <label for="positionId">Position select</label>
    <select class="form-control" id="positionId">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="leaderId">Leader select</label>
    <select class="form-control" id="leaderId">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone"
    pattern="([\+]\d{2}[\(]\d{3}[\)]\d{7})|([\+]\d{2}[\(]\d{4}[\)]\d{6})|([\+]\d{2}[\(]\d{5}[\)]\d{5})|\d{10}"
    required
    >
    ([\+] \d{2} [\(] \d{5} [\)] \d{5}) | \d{10
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <input type="text" class="form-control" name="salary" id="salary" placeholder="Salary">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>

  <button type="submit" class="btn btn-primary mb-2">Update User</button>
</form>

  @endsection