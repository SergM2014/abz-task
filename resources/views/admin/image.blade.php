@extends('layouts.admin')

@section('content')

      <div class="col-md-12 col-sm-12 col-xs-12" id="imgBlock">
         <input type="hidden" name="photo" id="employeePhoto">
        <!-- File preview --> 
        <div id="filepreview" class="displaynone" > 
          <img src="{{ asset('storage/no-avatar.png') }}" class="rounded border border-primary" with="150px" height="150px">
          
         </div>

         <div class="mt-3 d-none" id="rotateControlBlock">
               <button type="button" class="btn btn-info btn-sm" id="rotateLeft">Rotate Left</button>
               <button type="button" class="btn btn-info btn-sm" id="rotateRight">Rotate Right</button>
            </div>

        <!-- Form -->
        <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File    <span class="required">*</span></label>
           <div class="col-md-6 col-sm-6 col-xs-12">

              <input type='file' id="image" name='image' class="form-control">
              
           </div>
           
        </div>

        <div class="form-group">
           <div class="col-md-6">
              <input type="button" id="uploadImage" value='Upload Image' class='btn btn-success'>
              <button type="button" class="btn btn-danger" id="deleteImage" >Delete Image</button>
           </div>
        </div>
      </div>              

  @endsection