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

let requestData; // Variável global para armazenar a resposta do AJAX

function request() {
    $.ajax({
        url: '/estoque/src/Controller/User/UserController.php',
        method: 'POST',
        data:{
            'method': "userRequest"
        },
        success: function(response) {
            requestData = response; // Armazenar a resposta do AJAX na variável global
            let tabela = $('.elements');
            tabela.empty();

            let existingNames = {};

            requestData.forEach(element => {
                if (!existingNames[element.name]) {
                    let tr = $('<tr>');
                    tr.html(`
                        <td>${element.name}</td>
                        <td>${element.email}</td>
                        <td>${element.type}</td>
                        <td onclick="editTrigger('${element.pkUser}')">${element.pkUser}</td>
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

function editTrigger(pkUser){
    let update = document.getElementById('update');

    if (update){
        document.body.removeChild(update);
    }

    let editForm = document.createElement('form');
    editForm.method = 'POST';
    editForm.id = 'update';
    editForm.className = 'update';

    let inputs = ['name', 'email', 'password', 'type'];

    pkUser = pkUser - 1;

    let userData = requestData[pkUser];

    console.log("pk user", pkUser);

    console.log('userData:', userData); // Adicionando um log para verificar os dados do usuário

    inputs.forEach(function (element) {
        let newInput = document.createElement('input');
        let label = document.createElement('label');
        
        label.innerHTML = element;

        newInput.name = element;
        newInput.id = `${element}Update`;
        newInput.value
        // newInput.value = userData[element] || ''; // Preenchendo os valores dos campos do formulário com os dados do usuário

        newInput.setAttribute('value', userData[element] || '');

        if (element == 'type') {
            newInput = document.createElement('select');
            newInput.name = 'type';
            newInput.id = `typeUpdate`;

            let types =  ["Administrator", "Assistant"];

            types.forEach(function (type){
                let option = document.createElement('option');
                option.value = type;
                option.innerHTML = type;
                newInput.appendChild(option);    
            });
        }   

        editForm.appendChild(label);
        editForm.appendChild(newInput);
    });

    let button = document.createElement('button');
    button.type = 'submit';
    button.setAttribute('form', 'update');
    button.innerHTML = 'Send';

    document.body.appendChild(editForm);
    editForm.appendChild(button);

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
    editForm.appendChild(button);

    upAwait(pkUser);

}

function upAwait(pkUser){
    
    $(document).ready(function() {
        var formulario = $('#update');
        
        formulario.submit(function(event) {
            event.preventDefault();
            
            let name = $('#nameUpdate').val();
            let email = $('#emailUpdate').val();
            let password = $('#passwordUpdate').val();
            let type = $('#typeUpdate').val();
            
            pkUser = pkUser + 1 // reimplementado o valor decrementado na função editTrigger para proder manipular a array
            
            console.log(pkUser, name, email, password, type);
            
            $.ajax({
                url: '/estoque/src/Controller/User/UserController.php',
                method: 'POST',
                data: {
                'pkUser': pkUser,
                'name': name,
                'email': email,
                'password': password,
                'type': type,
                'method': "userUpdate"
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
        pkUser = pkUser -1 ;
    });
});
}