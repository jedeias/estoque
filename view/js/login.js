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

        if(response == "success") {

            window.location.href = "/estoque/view/index.php";

        }

        let responseUser = document.createElement("div");

        responseUser.className = "response";

        let body = document.querySelector("body");

        body.appendChild(responseUser);

        $("responseUser").html("password or email is worng");

    }).fail(function(xhr, status, error) {
        console.log(error);
        showErrorMessage();
    });
});

function showErrorMessage() {
    let existingResponse = document.querySelector(".response");
    
    if (!existingResponse) {
        let responseUser = document.createElement("div");
        responseUser.className = "response";
        
        let body = document.querySelector("body");
        body.appendChild(responseUser);
        
        $(".response").html("Password or email is wrong");
    }
}