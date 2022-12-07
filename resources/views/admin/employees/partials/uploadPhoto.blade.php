<div class="col-md-12 col-sm-12 col-xs-12" id="imgBlock">
    <label for="salary">Photo upload</label>
        <input type="hidden" name="photo" id="employeePhoto" value="{{ $photo }}">
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