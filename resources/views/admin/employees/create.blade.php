@extends('layouts.admin')

@section('content')

<h2> Create new Employee </h2>

<form class="m-3" method="post" action="{{ route('employees.store') }}">
  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control <?= $errors->has('firstName')? 'is-invalid' : '' ?>" 
    name="firstName" id="firstName" value="{{ old('firstName') }}" placeholder="First Name"
   >
   <div class="invalid-feedback"><?= $errors->first('firstName') ?></div>
  </div>
  <div class="form-group">
    <label for="middleName">Middle Name</label>
    <input type="text" class="form-control <?= $errors->has('middleName')? 'is-invalid' : '' ?>" 
    name="middleName" id="middleName" value="{{ old('middleName') }}" placeholder="Middle Name" 
   >
   <div class="invalid-feedback"><?= $errors->first('middleName') ?></div>
  </div>
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control <?= $errors->has('lastName')? 'is-invalid' : '' ?>" 
    name="lastName" id="lastName" value="{{ old('lastName') }}" placeholder="Last Name"
    >
    <div class="invalid-feedback"><?= $errors->first('lastName') ?></div>
  </div>
  
  <div class="form-group">
    <label for="positionId">Position select</label>
    <select class="form-control <?= $errors->has('positionId')? 'is-invalid' : '' ?>"
     id="positionId"  name="positionId">
      @foreach  ($positions as $position)
      <option value= "{{ $position->id }}" 
      @if(old('positionId') == $position->id ) selected @endif
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
    name="employmentDate" id="employmentDate" value="{{ old('employmentDate') }}" placeholder="employmentDate"
     >
     <div class="invalid-feedback"><?= $errors->first('employmentDate') ?></div>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <div class="text-red">
    <smal>Put phone only in following formats: +38(066)1234567 +38(0661)123456 +38(06612)12345 1234567</smal>
    </div>
    <input type="tel" class="form-control <?= $errors->has('phone')? 'is-invalid' : '' ?>" 
    name="phone" id="phone" value="{{ old('phone') }}" placeholder="Phone"
     >
     <div class="invalid-feedback"><?= $errors->first('phone') ?></div>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control <?= $errors->has('email')? 'is-invalid' : '' ?>"
     name="email" id="email" value="{{ old('email') }}" placeholder="email"
       >
       <div class="invalid-feedback"><?= $errors->first('email') ?></div>
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <div class="text-red">
    <smal>if sum is decimal, use  delimeter -comma, after comma 3 numbers are allowed. the max sum is 500,000 </smal>
    </div>
    <input type="number" class="form-control <?= $errors->has('salary')? 'is-invalid' : '' ?>"
     name="salary" id="salary" value="{{ old('salary') }}" placeholder="Salary" 
     step="0.001">
     <div class="invalid-feedback"><?= $errors->first('salary') ?></div>
  </div>
  
  <!-- upload file section -->
  <div class="col-md-12 col-sm-12 col-xs-12" id="imgBlock">
  <label for="salary">Photo upload</label>
         <input type="hidden" name="photo" id="employeePhoto">
        <!-- File preview --> 
        <div id="filepreview" class="mb-3" > 
          <img src="{{ asset('storage/uploads/thumbs/'.$photo) }}" class="rounded border border-primary" with="150px" height="150px">
          
         </div>

         <div class="my-3 d-none" id="rotateControlBlock">
               <button type="button" class="btn btn-info btn-sm" id="rotateLeft">Rotate Left</button>
               <button type="button" class="btn btn-info btn-sm" id="rotateRight">Rotate Right</button>
            </div>

        <div class="form-group">

            <input type='file' id="image" name='image' class="form-control" >
              
        </div>

        <div class="form-group">
           <div class="col-md-6">
              <input type="button" id="uploadImage" value='Upload Image' class='btn btn-success'>
              <button type="button" class="btn btn-danger" id="deleteImage" >Delete Image</button>
           </div>
        </div>
      </div>      

    <div class="text-center">
      <button type="submit" class="btn btn-primary mb-2 btn-lg">Update User</button>
    </div>
</form>                   
                

  @endsection