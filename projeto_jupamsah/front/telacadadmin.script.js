document.getElementById('cadastrar').addEventListener('click', function() {

    var nome = document.getElementById('nome').value; 
    var email = document.getElementById('email').value; 
    var cpf = document.getElementById('cpf').value;
    var matricula = document.getElementById('matricula').value;
    var cargo = document.getElementById('cargo').value;
    var localtrabalho = document.getElementById('localtrabalho').value;

    fazerRequisicao(1, undefined, nome, email, cpf, matricula, cargo, localtrabalho);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('listar').addEventListener('click', function(){
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
});

document.getElementById('atualizar').addEventListener('click', function(){
    var id = document.getElementById('id').value; 
    var nome = document.getElementById('nome').value; 
    var email = document.getElementById('email').value; 
    var cpf = document.getElementById('cpf').value;
    var matricula = document.getElementById('matricula').value;
    var cargo = document.getElementById('cargo').value;
    var localtrabalho = document.getElementById('localtrabalho').value;

    fazerRequisicao(3, id, nome, email, cpf, matricula, cargo, localtrabalho);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('deletar').addEventListener('click', function(){
    var id = document.getElementById('id').value;

    fazerRequisicao(4, id, undefined, undefined, undefined, undefined, undefined, undefined);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
});

function fazerRequisicao(tipo, id, nome, email, cpf, matricula, cargo, localtrabalho) {
    var url = `http://localhost/projeto_front-end/back/data/cadadmin.index.php?tipo=${tipo}&`;

    if (id !== undefined){
        url += `id=${id}&`;
    }
    if (nome !== undefined){
        url += `nome=${nome}&`;
    }
    if (email !== undefined){
        url += `email=${email}&`;
    }
    if (cpf !== undefined){
        url += `cpf=${cpf}&`;
    }
    if (matricula !== undefined){
        url += `matricula=${matricula}&`;
    }
    if (cargo !== undefined){
        url += `cargo=${cargo}&`;
    }
    if (localtrabalho !== undefined){
        url += `localtrabalho=${localtrabalho}&`;
    }

    fetch(url, {method: 'get'}).then(function(response){
        if (tipo == 2) {
           return response.json(); 
        }   
    }).then(function (data) {
        let cadadmin = data;  
        console.log(data);
        let table = document.getElementsByTagName("table");
        let linhas = "";

        for (let i = 0; i < data.length; i++) { 
            console.log("Objeto:", data[i]); // Verifica se os valores dos objetos estão corretos
            linhas += `<tr>` +
                        `<td>${data[i].id}</td>` +
                        `<td>${data[i].nome}</td>`+ 
                        `<td>${data[i].email}</td>` +
                        `<td>${data[i].cpf}</td>` +
                        `<td>${data[i].matricula}</td>` +
                        `<td>${data[i].cargo}</td>` +
                        `<td>${data[i].localtrabalho}</td>` +
                      `</tr>`;
        }

        table[0].innerHTML = "";
        table[0].innerHTML = `<tr>` +
        `<th>ID</th>` +
        `<th>Nome</th>` +
        `<th>Email</th>` +
        `<th>CPF</th>` +
        `<th>Matrícula</th>` +
        `<th>Cargo</th>` +
        `<th>Local de Trabalho</th>` +
        `</tr>` + linhas;
    })
    .catch(function(error){
        console.log(error);
    });

    document.getElementById('id').value = ""; 
    document.getElementById('nome').value = ""; 
    document.getElementById('email').value = ""; 
    document.getElementById('cpf').value = ""; 
    document.getElementById('matricula').value = ""; 
    document.getElementById('cargo').value = ""; 
    document.getElementById('localtrabalho').value = ""; 
}
