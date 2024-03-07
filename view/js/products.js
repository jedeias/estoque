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
            url: "/estoque/src/Controller/Product/ProductController.php",
            method: 'POST',
            data:{
                'name': nameProduct,
                'price': price,
                'mark': mark,
                'validate': validate,
                'method': "productRegister"
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

let productData;

function requestProducts() {
    $.ajax({
        url: "/estoque/src/Controller/Product/ProductController.php",
        method: 'POST',
        data:{
            'method': 'productRequest'
        },
        success: function(resultado) {
            console.log(resultado);

            productData = resultado; // Variável global para armazenar a resposta do AJAX

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
                    tr.append(`<td onclick="editTrigger(${item.pkProduct})">${item.pkProduct}</td>`);
                    
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

function editTrigger(item){

    let update = document.getElementById('update');

    if (update){
        document.body.removeChild(update);
    }

    let editForm = document.createElement('form');
    editForm.method = 'POST';
    editForm.id = 'update';
    editForm.class = 'update';

    let inputs = ['name', 'price', 'mark', 'date'];

    data = productData[item - 1]; // decrementando uma unidade para poder manipular a array corretamente
    
    inputs.forEach(function (element) {
        
        let newInput = document.createElement('input');
        let label = document.createElement('label');

        label.innerHTML = element;

        newInput.name = element;
        newInput.value = data[element];
        newInput.id = `${element}Update`;

        if (element == 'date') {
            newInput.type = 'date';
            
        }   

        editForm.append(label);
        editForm.append(newInput);

    });


    let button = document.createElement('button');
    button.type = 'submit';
    button.setAttribute('form', 'update');
    button.innerHTML = 'Send';
    
    // Criando o botão de fechar com um ícone
    let closeButton = document.createElement('i');
    closeButton.className = 'fas fa-times'; // Classe do FontAwesome para um ícone de fechar
    closeButton.style.fontSize = '34px'
    closeButton.style.position = 'absolute'
    closeButton.style.bottom = '85%'
    closeButton.style.left = '80%'
    closeButton.addEventListener('click', function() {
        document.body.removeChild(editForm);
    });
    
    editForm.appendChild(button); // Adicionando o botão de fechar ao formulário
    editForm.appendChild(closeButton);
    document.body.appendChild(editForm);

    updateProduct(item);

}

function updateProduct(productKey) {

    $(document).ready(function() {
        var formulario = $('#update');
        
        formulario.submit(function(event) {
            event.preventDefault();
            
            let name = $('#nameUpdate').val();
            let price = $('#priceUpdate').val();
            let mark = $('#markUpdate').val();
            let data = $('#dateUpdate').val();
            
            console.log(productKey, name, price, mark, data);
            
            $.ajax({
                url: '/estoque/src/Controller/Product/ProductController.php',
                method: 'POST',
                data: {
                'pk': productKey,
                'name': name,
                'price': price,
                'mark': mark,
                'validate': data,
                'method': "productUpdate"
            },
            dataType: 'json',
            success:function(){
                requestProducts();
            },
            error: function(xhr, status, error) {
                console.log(error);
                requestProducts();
            }

            });
        });
    });
}