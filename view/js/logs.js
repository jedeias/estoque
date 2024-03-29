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
var toggle = document.getElementById("toggle");
var refresh = document.getElementById("refresh");
var theme = window.localStorage.getItem("theme");

if (theme === "dark") document.body.classList.add("dark");

toggle.addEventListener("click", () => {
  document.body.classList.toggle("dark");
  if (theme === "dark") {
    window.localStorage.setItem("theme", "light");
  } else window.localStorage.setItem("theme", "dark");
});

refresh.addEventListener("click", () => {
  window.location.reload();
});


