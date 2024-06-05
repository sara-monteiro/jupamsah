document.getElementById('cadastrar').addEventListener('click', function() {
    var nomeleitor = document.getElementById('nomeleitor').value; 
    var emailleitor = document.getElementById('emailleitor').value; 
    var datanascimento = document.getElementById('datanascimento').value; 
    var cpf = document.getElementById('cpf').value; 
    var enderecocompleto = document.getElementById('enderecocompleto').value; 

    fazerRequisicao(1, undefined, nomeleitor, emailleitor, datanascimento, cpf, enderecocompleto);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('listar').addEventListener('click', function(){
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined);
});

document.getElementById('atualizar').addEventListener('click', function(){
    var id = document.getElementById('id').value = "";
    var nomeleitor = document.getElementById('nomeleitor').value; 
    var emailleitor = document.getElementById('emailleitor').value; 
    var datanascimento = document.getElementById('datanascimento').value; 
    var cpf = document.getElementById('cpf').value; 
    var enderecocompleto = document.getElementById('enderecocompleto').value; 

    fazerRequisicao(3, id, nomeleitor, emailleitor, datanascimento, cpf, enderecocompleto);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('deletar').addEventListener('click', function(){
    var id = document.getElementById('id').value;

    fazerRequisicao(4, id, undefined, undefined, undefined, undefined); // primary key
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined);
});

function fazerRequisicao(tipo, id, nomeleitor, emailleitor, datanascimento, cpf, enderecocompleto) {
    var url = `http://localhost/projeto_front-end/back/data/cadleitor.index.php?tipo=${tipo}&`;

    if (id !== undefined){
        url += `id=${id}&`;
    }
    if (nomeleitor !== undefined){
        url += `nomeleitor=${nomeleitor}&`;
    }
    if (emailleitor !== undefined){
        url += `emailleitor=${emailleitor}&`;
    }
    if (datanascimento !== undefined){
        url += `datanascimento=${datanascimento}&`;
    }
    if (cpf !== undefined){
        url += `cpf=${cpf}&`;
    }
    if (enderecocompleto !== undefined){
        url += `enderecocompleto=${enderecocompleto}&`;
    }

    fetch(url, {method: 'get'}).then(function(response){
        if (tipo == 2) {
           return response.json(); 
        }   
    }).then(function (data) {
        let cadleitor = data;  //conforme banco
        let table = document.getElementsByTagName("table");
        let linhas = "";

        for (var i=0; i< cadleitor.length; i++) { //conforme banco
            linhas += "<tr>"
            + `<td>${cadleitor[i].id}</td>` 
            + `<td>${cadleitor[i].nomeleitor}</td>` 
            + `<td>${cadleitor[i].emailleitor}</td>`
            + `<td>${cadleitor[i].datanascimento}</td>`
            + `<td>${cadleitor[i].cpf}</td>`
            + `<td>${cadleitor[i].enderecocompleto}</td>`
            + "</tr>";
        }

        table[0].innerHTML = ""
        table[0].innerHTML = "<tr>"
        + "<th>ID</th>"
        + "<th>Nome</th>"
        + "<th>Email</th>"
        + "<th>Data de Nascimento</th>"
        + "<th>CPF</th>"
        + "<th>Endereço completo</th>"
        + "</tr>"
        + linhas;

    }).catch(function(error){
          console.log(error);
    });
    
    document.getElementById('id').value = "";
    document.getElementById('nomeleitor').value = ""; 
    document.getElementById('emailleitor').value = ""; 
    document.getElementById('datanascimento').value = ""; 
    document.getElementById('cpf').value = ""; 
    document.getElementById('enderecocompleto').value = ""; 
}
