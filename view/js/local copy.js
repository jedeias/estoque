$(document).ready(function() {
    var formulario = $('#POST');

    formulario.submit(function(event) {
        event.preventDefault();

        var local = $('#local').val();
        var product = $('#product').val();
        var amount = $('#amount').val();
        
        $.ajax({
            url: '/estoque/src/Controller/Local/LocalRegister.php',
            method: 'POST',
            data: {
                "local": local,
                "product": product,
                "amount": amount,
                "method": 'localRegister'
            },
            // dataType: 'json',
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


function requestTable(callback) {
    $.ajax({
        url: '/estoque/src/Controller/Local/LocalController.php',
        method: 'POST',
        data:{
            'method': 'localRequest'
        },
        success: function(response) {
            localData = response;

            let tabela = $('.elements');
            tabela.empty();

            let existingElements = {};
            productsData = request;
            if (callback) {
                callback(productsData); // Chama o callback passando os dados recuperados
            }

            response.forEach(element => {

                let tr = $('<tr>');
                tr.html(`
                    <td>${element.local}</td>
                    <td>${element.name}</td>
                    <td>${element.price}</td>
                    <td>${element.amount}</td>
                    tr.append(<td onclick="editTrigger(${element.pklocation})"> ${element.pklocation} </td>);
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


function requestProducts(callback) {
    $.ajax({
        url: '/estoque/src/Controller/Product/ProductController.php',
        method: 'POST',
        data:{
            'method': "productRequest",
        },
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

            productData = request
            callback(productData);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}


let productsData;
requestProducts();

let localData;
requestTable();

console.log('products', productsData);
console.log('local', localData);

function editTrigger(pk){
    
    let update = document.getElementById('update');

    if (update){
        document.body.removeChild(update);
    }

    let editForm = document.createElement('form');
    editForm.method = 'POST';
    editForm.id = 'update';
    editForm.class = 'update';

    let inputs = ['local', 'products', 'price', 'amonunt'];

    inputs.forEach(function (element) {
        
        let newInput = document.createElement('input');
        let label = document.createElement('label');

        label.innerHTML = element;

        newInput.name = element;

        newInput.id = `${element}Update`;

        if (element == 'products') {

            newInput.type = 'select';
        
        }   

        editForm.append(label);
        editForm.append(newInput);

    });

    let button = document.createElement('button');
    button.type = 'submit';

    editForm.appendChild(button);

    document.body.appendChild(editForm);
}