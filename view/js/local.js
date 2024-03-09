let localData; // Declarada fora da função
let productsData; // Declarada fora da função

$(document).ready(function() {
    const formulario = $('#POST');

    formulario.submit(function(event) {
        event.preventDefault();

        const local = $('#local').val();
        const product = $('#product').val();
        const amount = $('#amount').val();
        
        $.ajax({
            url: '/estoque/src/Controller/Local/LocalController.php',
            method: 'POST',
            data: {
                local: local,
                product: product,
                amount: amount,
                method: 'localRegister'
            },
            success: function() {
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
        url: '/estoque/src/Controller/Local/LocalController.php',
        method: 'POST',
        data: {
            method: 'localRequest'
        },
        success: function(response) {
            const tabela = $('.elements');
            tabela.empty();

            const existingElements = {};

            response.forEach(element => {
                const tr = $('<tr>');
                tr.html(`
                    <td>${element.local}</td>
                    <td>${element.name}</td>
                    <td>${element.price}</td>
                    <td>${element.amount}</td>
                    <td onclick="editTrigger(${element.pklocation})">${element.pklocation}</td>
                `);
                tabela.append(tr);
                existingElements[element.pkProduct + element.name] = true;
            });

            // Atualiza localData após a conclusão da requisição AJAX
            localData = response;
            
            // Chama a função que depende de localData
            console.log('local', localData);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function requestProducts() {
    $.ajax({
        url: '/estoque/src/Controller/Product/ProductController.php',
        method: 'POST',
        data: {
            method: 'productRequest',
        },
        success: function(request) {
            const product = $('.products');
            product.empty();
            
            const existingNames = {};

            productsData = request; // Atribuição dentro do bloco de sucesso

            request.forEach(element => {
                if (!existingNames[element.name]) {
                    const option = $('<option>');
                    option.text(element.name);
                    option.val(element.pkProduct);
                    product.append(option);
                    existingNames[element.name] = true; 
                }
            });

            // Chama a função que depende de productsData
            console.log('products', productsData);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

requestTable();
requestProducts();


function editTrigger(pk) {
    let update = document.getElementById('update');

    if (update) {
        document.body.removeChild(update);
    }

    let editForm = document.createElement('form');
    editForm.method = 'POST';
    editForm.id = 'update';
    editForm.classList.add('update');

    let inputs = ['local', 'product', 'amount'];

    let data = localData[pk-1]; // Decrementando uma unidade para manipular a array corretamente

    inputs.forEach(function(element) {
        let label = document.createElement('label');
        label.innerHTML = element;
    
        if (element === 'product') {
            let selectInput = document.createElement('select');
            selectInput.name = element;
            selectInput.id = `${element}Update`;
    
            // Adiciona opções ao elemento de seleção
            productsData.forEach(item => {
                const option = document.createElement('option');
                option.text = item.name;
                option.value = item.pkProduct;
                selectInput.appendChild(option);
            });
    
            editForm.appendChild(label);
            editForm.appendChild(selectInput);
        } else {
            let newInput = document.createElement('input');
            newInput.name = element;
            newInput.value = data[element];
            newInput.id = `${element}Update`;
            editForm.appendChild(label);
            editForm.appendChild(newInput);
        }
    });
    
    let button = document.createElement('button');
    button.type = 'submit';
    button.setAttribute('form', 'update');
    button.innerHTML = 'Send';

    // Criando o botão de fechar com um ícone
    let closeButton = document.createElement('i');
    closeButton.className = 'fas fa-times'; // Classe do FontAwesome para um ícone de fechar
    closeButton.style.fontSize = '34px';
    closeButton.style.position = 'absolute';
    closeButton.style.bottom = '85%';
    closeButton.style.left = '80%';
    closeButton.addEventListener('click', function() {
        document.body.removeChild(editForm);
    });

    editForm.appendChild(button);
    editForm.appendChild(closeButton);
    document.body.appendChild(editForm);

    updateProducts(pk)
}

function updateProducts(pk) {

    $(document).ready(function() {
        var formulario = $('#update');
        
        formulario.submit(function(event) {
            event.preventDefault();
            
            let local = $('#localUpdate').val();
            let product = $('#productUpdate').val();
            let amount = $('#amountUpdate').val();
            
            // pk++ // reimplementado o valor decrementado na função editTrigger para proder manipular a array
            
            console.log(pk, local, product, amount);
            
            $.ajax({
                url: '/estoque/src/Controller/Local/LocalController.php',
                method: 'POST',
                data: {
                'pk': pk,
                'local': local,
                'product': product,
                'amount': amount,
                'method': "localUpdate"
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
        pkUser = pkUser -1 ;
    });
});
    
}