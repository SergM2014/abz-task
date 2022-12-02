document.onclick =  function(e){

    if(e.target.closest('#showEmployeesTable')) {
    
        let employeesCard = document.getElementById('employeesCard');
        
        if(employeesCard.classList.contains('d-none')) {
            employeesCard.classList.remove('d-none');
            // populate db
        } else {
            employeesCard.classList.add('d-none')
        } 
        closeCardSiblings('employeesCard');
    }

    if(e.target.classList.contains('deleteUser')) {

        let metaElement = document.getElementsByName('csrf-token');
        let csrf = metaElement[0].getAttribute('content');

        let id = e.target.dataset.id;

        let formData = new FormData;
        formData.append('id',id)
        formData.append('_token', csrf)

        fetch( '/admin/users/delete',{
            method: 'post',
            body: formData,
            credentials: 'same-origin'
         }
        )
        .then(response => response.status)
        .then(status => {
            if(status == 200) { 
                $('#usersTable').DataTable(populateUsersDb());
                $(document).Toasts('create', {
                    title: 'Succeeded!',
                    body: 'The user was deleted.',
                    class: 'btn-success',
                })
               
            }
        })
    }

    if(e.target.closest('#showPositionsTable')) {
 
        let positionsCard = document.getElementById('positionsCard');
        
        if(positionsCard.classList.contains('d-none')) {
            positionsCard.classList.remove('d-none');
            //  populate db?
        } else {
            positionsCard.classList.add('d-none')
        } 
        closeCardSiblings('positionsCard')
    }

};

function closeCardSiblings(currentId)
{
    let siblings = document.querySelectorAll('.card');
    siblings.forEach(element => {
        if(element.id != currentId ) {
            element.classList.add('d-none');
        }
    });
}