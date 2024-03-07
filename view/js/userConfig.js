$(document).ready(function() {
    let formulario = $('#UPDATE');

    formulario.submit(function(event) {
        event.preventDefault();

        let userName = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        
        $.ajax({
            url: '/estoque/src/Controller/User/UserController.php',
            method: 'POST',
            data: {
                'name': userName,
                'email': email,
                'password': password,
                'method': "userUpdateAuth",
            },
            success:function(response){
                const status = document.createElement("div");
                status.classList.add("status");
                
                document.body.appendChild(status);
                
                if(response !== false){

                    status.innerHTML = "your aconnection has been updated";
                    
                }else{
                    status.innerHTML = "sorry we cant update your aconnection";
                }

                setTimeout(function() {
                    document.body.removeChild(status);
                }, 3000);
            },
        });
    });
});
