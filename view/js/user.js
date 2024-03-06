$(document).ready(function() {
    var formulario = $('#POST');

    formulario.submit(function(event) {
        event.preventDefault();

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var type = $('#type').val();

        $.ajax({
            url: '/estoque/src/Controller/User/UserController.php',
            method: 'POST',
            data: {
                'name': name,
                'email': email,
                'password': password,
                'type': type,
                'method': "userRegister"
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
        url: '/estoque/src/Controller/User/UserController.php',
        method: 'POST',
        data:{
            'method': "userRequest"
        },
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
                        <td onclick="editTrigger(${element.pkUser})">${element.pkUser}</td>
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

function editTrigger(item) {
    let update = document.getElementById('update');
    
    if (update) {
        document.body.removeChild(update);
    }

    let editForm = document.createElement('form');
    editForm.method = 'POST';
    editForm.id = 'update';
    editForm.className = 'update'; // Corrigido de class para className
    editForm.innerHTML = '<h1>Edit</h1>';
    

    let inputs = ['name', 'email', 'password', 'type'];

    inputs.forEach(function (element) {
        
        let newInput = document.createElement('input');
        let label = document.createElement('label');

        label.innerHTML = element;

        newInput.name = element;
        newInput.id = element;

        if (element == 'date') { // Corrigido de newInput == 'date' para element == 'date'
            newInput.type = 'date';
        }   

        editForm.append(label);
        editForm.append(newInput);
    });

    let button = document.createElement('button');
    button.type = 'submit';
    button.innerHTML = 'Enviar';

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

    // Adicionando o botão de fechar ao formulário
    editForm.appendChild(button);
    editForm.appendChild(closeButton);

    document.body.appendChild(editForm);
}

