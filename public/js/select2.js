$(document).ready(function () {
    if( $('#leaderIdSelect')){
        $('#leaderIdSelect').select2({
            minimumInputLength: 3,
            ajax: {
                url: '/api/employee/search',
                dataType: 'json',
            },
        });
    }

    let leaderId = $('#leaderId').val();
 
    // Fetch the preselected item, and add to the control
    let leaderSelect = $('#leaderIdSelect');
    fetch( '/api/employee/leader/' + leaderId,
            { method: 'GET',
          credentials:'same-origin'
        })
        .then((response) => response.json())
        .then(function (data) {

        // create the option and append to Select2
        let option = new Option(data.text, data.id,  true, true);

    leaderSelect.append(option).trigger('change');

    // manually trigger the `select2:select` event
    leaderSelect.trigger({
        type: 'select2:select',
        params: {
            data: data
        }
     });
    });


  });