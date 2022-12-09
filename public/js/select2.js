$(document).ready(function () {
  
    if( $('#leaderIdSelect').length){

      searchEmployee();
      if (('#leaderId').val()) {
        getSelectedLeader();
      }
    }

    if ($('#anotherLeaderIdSelect').length) searchOtherLeaders();
  });

    if(document.getElementById("positionId")) {
      document.getElementById("positionId").addEventListener('change', function (e) {
        if($('#leaderIdSelect')){
          $('#leaderIdSelect').val(null).trigger('change');
        }
      })
    }

  function searchEmployee()
  {
    $('#leaderIdSelect').select2({

        minimumInputLength: 3,
        ajax: {
            url: '/api/employee/search',
            dataType: 'json',
            data: function (params) {
                var query = {
                  term: params.term,
                  positionId: $('#positionId').val()
                }
                // Query parameters will be ?term=[term]&positionId=[positionId]
                return query;
              }
        },
        
    });
  }

  function getSelectedLeader()
  {
     let leaderSelect = $('#leaderIdSelect');
     // Fetch the preselected item, and add to the control
     let id = $('#leaderId').val();
     if (!id) id = 0;

     fetch( '/api/employee/leader?leaderId=' + id,
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


  if($('#supremePositionId').length) {

    getSupremePositions();
    // searchSupremePositions();
    // if ($('#parentId').val()){
    //  getSelectedSupremePosition();
    // }
  }
  if(document.getElementById("subordinaryLevel")) {
    document.getElementById("subordinaryLevel").addEventListener('change', function (e) {
      if($('#supremePositionId')){
        $('#supremePositionId').val(null).trigger('change');
      }
    })
  }

  function searchSupremePositions()
  {
    $('#parentIdSelect').select2({

        minimumInputLength: 3,
        ajax: {
            url: '/api/position/search',
            dataType: 'json',
            data: function (params) {
                var query = {
                  term: params.term,
                  subordinaryLevel: $('#subordinaryLevel').val()
                }
                // Query parameters will be ?term=[term]&positionId=[positionId]
                return query;
              }
        },
        
    });
  }

  function getSelectedSupremePosition()
  {
    let selectedPosition = $('#parentIdSelect');
     // Fetch the preselected item, and add to the control
     let id = $('#parentId').val();
     if (!id) id = 0;

     fetch( '/api/position/supreme?parentId=' + id,
             { method: 'GET',
             credentials:'same-origin'
         })
         .then((response) => response.json())
         .then(function (data) {

             // create the option and append to Select2
             let option = new Option(data.text, data.id,  true, true);

             selectedPosition.append(option).trigger('change');

             // manually trigger the `select2:select` event
             selectedPosition.trigger({
                 type: 'select2:select',
                 params: {
                     data: data
                 }
             });
     });
  }
  function getSupremePositions()
  {
    let supremePositionSelect = $('#supremePositionIdSelect');
     // Fetch the preselected item, and add to the control
    
    let subordinaryLevel = $('#subordinaryLevel').val();
    if(!subordinaryLevel) subordinary = 1;
     let fd = new FormData;
     fd.append('subordinaryLevel', subordinaryLevel );

     fetch( '/api/position/supremes',
             { 
              method: 'post',
              body: fd,
              credentials:'same-origin'
              })
         .then((response) => response.json())
         .then(function (data) {

          data.results.forEach(function(item) {
            let option = new Option(item.text, item.id,  true, true);

            supremePositionSelect.append(option).trigger('change');
          })
             // create the option and append to Select2
            //  let option = new Option(data.text, data.id,  true, true);

            //  selectedPosition.append(option).trigger('change');

             // manually trigger the `select2:select` event
             supremePositionSelect.trigger({
                 type: 'select2:select',
                 params: {
                     data: data
                 }
             });
             //supremePositionSelect.select2('open');
     });
  }