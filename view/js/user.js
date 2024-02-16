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
            success:function(){
                request();
            },
            error: function(xhr, status, error) {
                console.log(error);
                request();
            }
        });
    });
});


function request() {
    $.ajax({
        url: '/estoque/src/Controller/User/UserRequest.php',
        success: function(request) {
            let tabela = $('.elements');
            tabela.empty();

            let existingNames = {};

            request.forEach(element => {
                if (!existingNames[element.name]) {
                    let tr = $('<tr>');
                    tr.html(`
                        <td>${element.name}</td>
                        <td>${element.email}</td>
                        <td>${element.type}</td>
                    `);
                    tabela.append(tr);
                    existingNames[element.name] = true; 
                }
            });
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

request();

$(document).ready(function(){

    $('#menu').click(function(){
        $(this).toggleClass('fa-times');
        $('header').toggleClass('toggle');
    });

    $(window).on('scroll load', function(){
        $('#menu').removeClass('fa-times');
        $('header').removeClass('toggle');
    });

    $('a[href*="#"]').on('click',function(e){

        e.preventDefault();

        $('html,body').animate({

            scrollTop : $($(this).attr('href')).offset().top,

        },
            500,
            'linear'
        );

    });

});

function mostrarInformacoes() {
    var informacoesDiv = document.getElementById("informacoes");
  
    if (informacoesDiv.style.display === "none") {
      informacoesDiv.style.display = "block";
    } else {
      informacoesDiv.style.display = "none";
    }


   
    
}
  

