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