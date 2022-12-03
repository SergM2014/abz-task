$(document).ready(function () {
    if( $('#leaderIdSelection')){
        $('#leaderIdSelect').select2({
            minimumInputLength: 3,
            ajax: {
                url: '/api/employee/search',
                dataType: 'json',
            },
        });
    }
  });