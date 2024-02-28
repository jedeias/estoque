$(document).ready(function() {
    var formulario = $('#POST');

    formulario.submit(function(event) {
        event.preventDefault();

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var type = $('#type').val();

        $.ajax({
            url: '/estoque/src/Controller/User/UserRegister.php',
            method: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                type: type
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
        url: '/estoque/src/Controller/User/UserRequest.php',
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

function editTrigger(item){

    let update = document.getElementById('update');

    if (update){
        document.body.removeChild(update);
    }

    let editForm = document.createElement('form');
    editForm.method = 'POST';
    editForm.id = 'update';
    editForm.class = 'update';

    let inputs = ['name', 'email', 'password', 'type'];

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
