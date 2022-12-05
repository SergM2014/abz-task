@extends('layouts.admin')

@section('content')

<h2> Edit new Employee # {{ $employee->id }}</h2>

<form class="m-3" method="post" action="{{ route('employees.update', $employee) }}">
  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control <?= $errors->has('firstName')? 'is-invalid' : '' ?>" 
    name="firstName" id="firstName" value="{{ old('firstName')?? $employee->first_name }}" placeholder="First Name"
   >
   <div class="invalid-feedback"><?= $errors->first('firstName') ?></div>
  </div>
  <div class="form-group">
    <label for="middleName">Middle Name</label>
    <input type="text" class="form-control <?= $errors->has('middleName')? 'is-invalid' : '' ?>" 
    name="middleName" id="middleName" value="{{ old('middleName')?? $employee->middle_name }}" placeholder="Middle Name" 
   >
   <div class="invalid-feedback"><?= $errors->first('middleName') ?></div>
  </div>
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control <?= $errors->has('lastName')? 'is-invalid' : '' ?>" 
    name="lastName" id="lastName" value="{{ old('lastName')?? $employee->last_name }}" placeholder="Last Name"
    >
    <div class="invalid-feedback"><?= $errors->first('lastName') ?></div>
  </div>
  
  <div class="form-group">
    <label for="positionId">Position select</label>
    <select class="form-control <?= $errors->has('positionId')? 'is-invalid' : '' ?>"
     id="positionId"  name="positionId">
      @foreach  ($positions as $position)
      <option value= "{{ $position->id }}" 
      @if($positionId == $position->id ) selected @endif
      >{{ $position->title }}</option>
      @endforeach
    </select>
    <div class="invalid-feedback"><?= $errors->first('positionId') ?></div>
  </div>
  <div class="form-group">
    <label for="leaderId">Leader select</label>
    <select name="leaderId" id="leaderIdSelect" class="form-control <?= $errors->has('leaderId')? 'is-invalid' : '' ?> select2" ></select>
    <div class="invalid-feedback"><?= $errors->first('leaderId') ?></div>
  </div>
  <div class="form-group">
    <label for="employmentDate">Employment Date</label>
        <input type="date" class="form-control <?= $errors->has('employmentDate')? 'is-invalid' : '' ?>" 
         name="employmentDate" id="employmentDate" value="{{ old('employmentDate')?? $employee->employment_date }}" placeholder="employmentDate"
     >
     <div class="invalid-feedback"><?= $errors->first('employmentDate') ?></div>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <div class="text-red">
    <smal>Put phone only in following formats: +38(066)1234567 +38(0661)123456 +38(06612)12345 1234567</smal>
    </div>
    <input type="tel" class="form-control <?= $errors->has('phone')? 'is-invalid' : '' ?>" 
    name="phone" id="phone" value="{{ old('phone')?? $employee->phone }}" placeholder="Phone"
     >
     <div class="invalid-feedback"><?= $errors->first('phone') ?></div>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control <?= $errors->has('email')? 'is-invalid' : '' ?>"
     name="email" id="email" value="{{ old('email')?? $employee->email }}" placeholder="email"
       >
       <div class="invalid-feedback"><?= $errors->first('email') ?></div>
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <div class="text-red">
    <smal>if sum is decimal, use  delimeter -comma, after comma 3 numbers are allowed. the max sum is 500,000 </smal>
    </div>
    <input type="number" class="form-control <?= $errors->has('salary')? 'is-invalid' : '' ?>"
     name="salary" id="salary" value="{{ old('salary')?? $employee->salary }}" placeholder="Salary" 
     step="0.001">
     <div class="invalid-feedback"><?= $errors->first('salary') ?></div>
  </div>
  
  @include('admin.employees.partials.uploadPhoto')
     
    <div class="text-center">
      <button type="submit" class="btn btn-primary mb-2 btn-lg">Update User</button>
    </div>
</form>                   
                

  @endsection