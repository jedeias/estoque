$.ajax({
    url: "/estoque/src/Controller/LogsRequest.php",
    success: function(resultado) {
        console.log(resultado);
        let tabela = document.querySelector('.elements');

        resultado.forEach(item => {
            let tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${item.alterTable}</td>
                <td>${item.alterColumn}</td>
                <td>${item.newValue}</td>
                <td>${item.alterType}</td>
                <td>${item.dateTime}</td>
            `;
            tabela.appendChild(tr);
        });
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});

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


var perfil = document.getElementById('perfil');
var info = document.getElementById('informacoes');

perfil.addEventListener('mouseover', function() {
    info.style.display = 'block';
  });


perfil.addEventListener('mouseout', function() {
    info.style.display = 'none';
  });