if (document.getElementById('employeesCard')) {

    document.getElementById('employeesCard').addEventListener('click', function(e){
        
        let parentEl = e.target.parentElement;
        if (parentEl.dataset.action == 'row_action_destroy') {

        let id = parentEl.dataset.id;

        fetch( '/api/employee/subordinates?id='+id,
            { 
                method: 'GET',
                credentials:'same-origin'
            })
                .then((response) => response.json())
                .then(function (data) {
                    if (data.length > 0) {
                        if (window.confirm("Do you really want to delet the employee? He has subordinates, they should get another leader. Continue?")) {
                            window.location.href = '/admin/leader/change?id='+id;
                          }
                    } else {
                       
                        if (window.confirm('Are You shure to delete the employee?')) {
                            // As explained above, just send back the 3 first argument from the `table:action:confirm` event when the action is confirmed
                            Livewire.emit(
                                'laraveltable:action:confirmed',
                                'rowAction',
                                'row_action_destroy',
                                id
                                );
                        }
                    alert(`The employee #${id} is deleted!`);
                    }
                })
            }

            
    })

}

;
