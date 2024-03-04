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

function requestProducts() {
    $.ajax({
        url: "/estoque/src/Controller/Product/ProductController.php",
        method: 'POST',
        data:{
            'method': 'productRequest'
        },
        success: function(resultado) {
            console.log(resultado);
            let tabela = $('.elements');
            
            tabela.empty();
            
            let existingNames = {};
            
            let img = document.createElement('img');
            img.src = "../image/edit.svg";



            resultado.forEach(item => {
                if (!existingNames[item.name]) {
                    let tr = $('<tr></tr>');
                    tr.append(`<td>${item.name}</td>`);
                    tr.append(`<td>${item.price}</td>`);
                    tr.append(`<td>${item.mark}</td>`);
                    tr.append(`<td>${item.validate}</td>`);
                    tr.append(`<td class='img' onclick="editTrigger(${item.pkProduct})"></td>`);
                    
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

    inputs.forEach(function (element) {
        
        let newInput = document.createElement('input');
        let label = document.createElement('label');

        label.innerHTML = element;

        newInput.name = element;
        newInput.id = element;

        if (newInput == 'date') {
            newInput.type = 'date';
            
        }   

        editForm.append(label);
        editForm.append(newInput);

    });

    let button = document.createElement('button');
    button.type = 'submit';

    editForm.appendChild(button);

    document.body.appendChild(editForm);
}

