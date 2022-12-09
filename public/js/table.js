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
            .then(function(data) {
console.log(data);
                if(data.success) {



                }
            })
        
        
        
        
        
        
        // fetch( '/api/employee/subordinates?id='+id,
        //     { 
        //         method: 'GET',
        //         credentials:'same-origin'
        //     })
        //         .then((response) => response.json())
        //         .then(function (data) {
        //             if (data.length > 0) {
        //                 if (window.confirm("Do you really want to delet the employee? He has subordinates, they should get another leader. Continue?")) {
        //                     window.location.href = '/admin/leader/change?id='+id;
        //                   }
        //             } else {
                       
        //                 if (window.confirm('Are You shure to delete the employee?')) {
        //                     window.location.href = '/admin/employee/delete?id='+id;
        //                 }
        //               }
        //         })
        }

            
    })

}