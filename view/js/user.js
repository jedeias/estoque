// $("#POST").submit(function(e){
//     e.preventDefault();

//     let name = $("#name").val();
//     let email = $("#email").val();
//     let password = $("#password").val();
//     let type = $("#type").val();
    

//     $.ajax({
//         url: "/estoque/src/Controller/User/UserRegister.php",
//         method: "POST",
//         data: JSON.stringify({
//             "name": name,
//             "email": email,
//             "password": password,
//             "type": type,
//         }),
//         dataType: "json",
//     }).done(function(response) {
//         console.log(response);
//     }).fail(function(xhr, status, error) {
//         console.log(error);
//     });
// });
$(document).ready(function() {
    var formulario = $('#POST');

    formulario.submit(function(event) {
        event.preventDefault();

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var type = $('#type').val();

        $.ajax({
            url: '/estoque/src/Controller/User/UserRegister.php',
            method: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                type: type
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});