$(document).ready(function () {
    if( $('#leaderIdSelect')){

        searchEmployee();
//only for edit form
    if ($('#leaderId').hasClass('update') ){
      getLeader();
    }
        
    if(document.getElementById("positionId")) {
        document.getElementById("positionId").addEventListener('change', function (e) {
            console.log("Changed to: " + e.target.value)
            $('#leaderIdSelect').val(null).trigger('change');
          })
        }
    }

    if ($('#anotherLeaderIdSelect')) {
      
      searchOtherLeaders();
    }
  });

  function searchEmployee()
  {
    let positionId = $('#positionId').val();

    $('#leaderIdSelect').select2({

        minimumInputLength: 3,
        ajax: {
            url: '/api/employee/search',
            dataType: 'json',
            data: function (params) {
                var query = {
                  term: params.term,
                  positionId: positionId
                }
                // Query parameters will be ?term=[term]&positionId=[positionId]
                return query;
              }
        },
    });
  }

  function getLeader()
  {
     let leaderSelect = $('#leaderIdSelect');
     // Fetch the preselected item, and add to the control
     let id = $('#leaderId').val();

     fetch( '/api/employee/leader/' + id,
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
  }

  function searchOtherLeaders()
  {
    let positionId = $('#positionId').val();
    let oldLeaderId = $('#oldLeaderId').val();

    $('#anotherLeaderIdSelect').select2({

        minimumInputLength: 3,
        ajax: {
            url: '/api/employee/search/leaders',
            dataType: 'json',
            data: function (params) {
                var query = {
                  term: params.term,
                  positionId: positionId,
                  id: oldLeaderId,
                }
                // Query parameters will be ?term=[term]&positionId=[positionId]
                return query;
              }
        },
    });
  }