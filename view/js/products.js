$(document).ready(function() {
    var formulario = $('#POST');

    formulario.submit(function(event) {
        event.preventDefault();

        let nameProduct = $('#name').val();
        let price = $('#price').val();
        let mark = $('#mark').val();
        let validate = $('#validate').val();
        
        console.log(nameProduct, price, mark, validate);

        $.ajax({
            url: "/estoque/src/Controller/Product/ProductRegister.php",
            method: 'POST',
            data:{
                'name': nameProduct,
                'price': price,
                'mark': mark,
                'validate': validate
            },
            success: function() {

                let tabela = $('.elements');
                tabela.empty();
                
                requestProducts();
            },
            error: function(xhr, status, error) {
                console.error(error);
                let tabela = $('.elements');
                tabela.empty();
                
                requestProducts();
            }
        });
    });
});

function requestProducts() {
    $.ajax({
        url: "/estoque/src/Controller/Product/ProductRequest.php",
        success: function(resultado) {
            console.log(resultado);
            let tabela = $('.elements');
            
            tabela.empty();
            
            let existingNames = {};
            
            resultado.forEach(item => {
                if (!existingNames[item.name]) {
                    let tr = $('<tr></tr>');
                    tr.append(`<td>${item.name}</td>`);
                    tr.append(`<td>${item.price}</td>`);
                    tr.append(`<td>${item.mark}</td>`);
                    tr.append(`<td>${item.validate}</td>`);
                    tabela.append(tr);
                    existingNames[item.name] = true; 
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

requestProducts();


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