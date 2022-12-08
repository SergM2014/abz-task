let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

$(document).ready(function(){

  $('#uploadImage').click(function(){
    // Get the selected file
    let images = $('#image')[0].files;

    if(images.length > 0){
        var fd = new FormData();

        // Append data 
        fd.append('image', images[0]);
        fd.append('_token', CSRF_TOKEN);

        // AJAX request 
        $.ajax({
          url: "/api/image/store",
          method: 'post',
          data: fd,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response){

            // Hide error container
            $('#err_file').removeClass('d-block');
            $('#err_file').addClass('d-none');

            if(response.success == 1){ // Uploaded successfully
            createAlert(response.message, 'alert-success')

             // File preview
            $('#filepreview').show();
            $('#filepreview img').attr('src', window.location.origin+'/storage/uploads/thumbs/'+response.savedFile);
            $('#rotateControlBlock').removeClass('d-none');
            
          
            $('#employeePhoto').val(response.savedFile);
               
             }else if(response.success == 2){ // File not uploaded

              $('#employeePhoto').val('');
               // Response message
               createAlert(response.message, 'alert-danger');
               $('#rotateControlBlock').addClass('d-none');
               
             }else{
               // Display Error
               createAlert(response.error, 'alert-danger');
               $('#rotateControlBlock').addClass('d-none');
             } 
           },
           error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }
         });
      }else{
        createAlert('Select a file!', 'alert-danger');
      }

    });

    $('#deleteImage').click(function(){
      if ($('#employeePhoto').val() == 'no-avatar.png') return;

        $('#filepreview img').attr('src', window.location.origin+'/storage/uploads/thumbs/no-avatar.png');
        document.getElementById('image').value = '';
       
        $('#employeePhoto').val('no-avatar.png');
        createAlert('image Is Deleted!', 'alert-danger');
        $('#rotateControlBlock').addClass('d-none');
  })

  function createAlert(msg, level)
  {
    let alert = document.createElement('div');
    alert.classList.add('alert', level,'alert-dismissible', 'fade', 'show');
    alert.innerHTML= `<strong>${msg}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>`;
    document.getElementById('imgBlock').prepend(alert);
  }

  $('#rotateLeft').click(function(){
    rotatePhoto(90);
  });

  $('#rotateRight').click(function(){
    rotatePhoto(270);
  });

  function rotatePhoto(degree)
  {
    let photo = $('#employeePhoto').val();
    let fd = new FormData();

    fd.append('degree', degree);
    fd.append('photo', photo);
    fd.append('_token', CSRF_TOKEN);

    $.ajax({
      url: "/api/image/rotate",
      method: 'post',
      data: fd,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response){
        $('#filepreview img').attr('src', window.location.origin+'/storage/uploads/thumbs/'+response.photo);
        $('#employeePhoto').val(response.photo);
      },
      error: function(response){
        createAlert('smthing went wrong!', 'alert-danger')
     }
    })
  }

})
