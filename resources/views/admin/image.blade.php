@extends('layouts.admin')

@section('content')


      <div class="col-md-12 col-sm-12 col-xs-12">

        <!-- Response message -->
        <div class="alert displaynone" id="responseMsg"></div>

        <!-- File preview --> 
        <div id="filepreview" class="displaynone" > 
          <img src="{{ asset('storage/777.png') }}" class="displaynone" with="200px" height="200px"><br>

          <a href="#" class="displaynone" >Click Here..</a>
        </div>

        <!-- Form -->
        <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File    <span class="required">*</span></label>
           <div class="col-md-6 col-sm-6 col-xs-12">

              <input type='file' id="image" name='image' class="form-control">

              <!-- Error -->
              <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>

           </div>
        </div>

        <div class="form-group">
           <div class="col-md-6">
              <input type="button" id="uploadImage" value='UploadImage' class='btn btn-success'>
           </div>
        </div>
      </div>
  
                    
                
            
      

  @endsection