$("#POST").submit(function(e) {
    e.preventDefault();

    let email = $("#email").val();
    let password = $("#password").val();

    if (!email || !password) {
        console.error("Email or password is empty");
        return;
    }

    $.ajax({
        url: "/estoque/src/Controller/login.php",
        method: "POST",
        data: JSON.stringify({
            "email": email,
            "password": password,
        }),
        dataType: "json",
    }).done(function(response) {
        console.log(response);
    }).fail(function(xhr, status, error) {
        console.log(error);
    });
});