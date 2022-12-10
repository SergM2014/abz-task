if (!CSRF_TOKEN) { let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content"); }

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
                            window.location.href = '/admin/employee/delete?id='+id;
                        }
                      }
                })
        }
     
    })

}


if (document.getElementById('positionsCard')) {
    
    document.getElementById('positionsCard').addEventListener('click', function(e){
        
        let parentEl = e.target.parentElement;
        if (parentEl.dataset.action == 'row_action_destroy') {

        let id = parentEl.dataset.id;

        fetch('/api/position/subpositions?id='+id,
            {
                method: "GET",
                credentials: 'same-origin'
            })
            .then((response) => response.json())
            .then(function(subPositions) {

                if(subPositions.success) {
                    fetch('/api/position/employees?id='+id,
                    {
                        method: "GET",
                        credentials: 'same-origin'
                    })
                    .then((response) => response.json())
                    .then(function(employees) {
                        if(employees.success) {
                            if (window.confirm('Are You shure to delete the position?')) {

                                let fd = new FormData;
                                fd.append('_token', CSRF_TOKEN);
                                fd.append('_method', 'delete');
                                fd.append('id', id);

                                fetch('/admin/positions/'+id,
                                {
                                    body: fd,
                                    method: "POST",
                                    credentials: 'same-origin'
                                })
                                .then((response) => response.json())
                                .then(function(deleteStatus) {
                                    window.location.href = '/admin/positions/delete?id='+id;
                                })
                                }
                        } else {
                            if (window.confirm('Are You shure to delete the position? Curent Position has employees!')) {
                                window.location.href = '/admin/positions/preprocess?employees=true&id='+id;
                            }
                        }
                    })

                } else {
                    //if has subposition
                    fetch('/api/position/employees?id='+id,
                    {
                        method: "GET",
                        credentials: 'same-origin'
                    })
                    .then((response) => response.json())
                    .then(function(employees) {
                        if(employees.success) {
                            if (window.confirm('Are You shure to delete the position? Curent Position has suordinary position!')) {
                                    window.location.href = '/admin/positions/preprocess?subpositions=true&id='+id;
                                }
                        } else {
                            if (window.confirm('Are You shure to delete the position? Curent Position has suordinary positions and employees!')) {
                                window.location.href = '/admin/positions/preprocess?subpositions=true&employees=true&id='+id;
                            }
                        }
                    })

                }
            })
        }     
    })
}
