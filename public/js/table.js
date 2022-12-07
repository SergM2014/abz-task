if (document.getElementById('employeesCard')) {
    let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
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

