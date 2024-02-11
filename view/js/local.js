$(document).ready(function() {
    var formulario = $('#POST');

    formulario.submit(function(event) {
        event.preventDefault();

        var local = $('#local').val();
        var product = $('#product').val();
        var amount = $('#amount').val();
        
        $.ajax({
            url: '/estoque/src/Controller/Local/LocalRegist.php',
            method: 'POST',
            data: {
                "local": local,
                "product": product,
                "amount": amount
            },
            dataType: 'json',
            success:function(){
                requestTable();
                requestProducts();
            },
            error: function(xhr, status, error) {
                console.log(error);
                requestTable();
                requestProducts();
            }
        });
    });
});


function requestTable() {
    $.ajax({
        url: '/estoque/src/Controller/Local/LocalRequest.php',
        success: function(request) {
            let tabela = $('.elements');
            tabela.empty();

            let existingElements = {};

            request.forEach(element => {
                
                console.log(element);

                let tr = $('<tr>');
                tr.html(`
                    <td>${element.local}</td>
                    <td>${element.name}</td>
                    <td>${element.price}</td>
                    <td>${element.amount}</td>
                `);
                tabela.append(tr);
                existingElements[element.pkProduct + element.name] = true;

            });

        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

requestTable();

function requestProducts() {
    $.ajax({
        url: '/estoque/src/Controller/Product/ProductRequest.php',
        success: function(request) {
            let product = $('.products');
            product.empty();

            let existingNames = {};

            request.forEach(element => {
                if (!existingNames[element.name]) {
                    let option = $('<option>');
                    option.text(element.name);
                    option.val(element.pkProduct);
                    product.append(option);
                    existingNames[element.name] = true; 
                }
            });
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

requestProducts();