$.ajax({
    url: "/estoque/src/Controller/LogsRequest.php",
    success: function(resultado) {
        console.log(resultado);
        let tabela = document.querySelector('.elements');

        resultado.forEach(item => {
            let tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${item.alterTable}</td>
                <td>${item.alterColumn}</td>
                <td>${item.newValue}</td>
                <td>${item.alterType}</td>
                <td>${item.dateTime}</td>
            `;
            tabela.appendChild(tr);
        });
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});
