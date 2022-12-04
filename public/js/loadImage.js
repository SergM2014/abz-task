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
            // $('#filepreview img').show();
            
          
            $('#employeePhoto').val(response.savedFile);
               
             }else if(response.success == 2){ // File not uploaded

              $('#employeePhoto').val('');
               // Response message
               createAlert(response.message, 'alert-danger')
               
             }else{
               // Display Error
               createAlert(response.error, 'alert-danger')
              //  $('#err_file').text(response.error);
              //  $('#err_file').removeClass('d-none');
              //  $('#err_file').addClass('d-block');
             } 
           },
           error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }
         });
      }else{
         alert("Please select a file.");
      }

    });

    $('#deleteImage').click(function(){
      if (!$('#employeePhoto').val()) return;

        $('#filepreview img').attr('src', window.location.origin+'/storage/no-avatar.png');
        document.getElementById('image').value = '';
       
        $('#employeePhoto').val('');
        createAlert('image Is Deleted!', 'alert-danger')
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

})
