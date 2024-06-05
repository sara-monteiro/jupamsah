document.getElementById('cadastrar').addEventListener('click', function() {

    var nomeleitor = document.getElementById('nomeleitor').value; 
    var emailleitor = document.getElementById('emailleitor').value; 
    var cpf = document.getElementById('cpf').value; 
    var livroescolhido = document.getElementById('livroescolhido').value;
    var genero = document.getElementById('genero').value;
    var dataretirada = document.getElementById('dataretirada').value;
    var datadevolucao = document.getElementById('datadevolucao').value;
    var avarias = document.getElementById('avarias').value;

    fazerRequisicao(1, undefined, nomeleitor, emailleitor, cpf, livroescolhido, genero, dataretirada, datadevolucao, avarias);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('listar').addEventListener('click', function(){
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
});

document.getElementById('atualizar').addEventListener('click', function(){
    var id = document.getElementById('id').value; 
    var nomeleitor = document.getElementById('nomeleitor').value; 
    var emailleitor = document.getElementById('emailleitor').value; 
    var cpf = document.getElementById('cpf').value; 
    var livroescolhido = document.getElementById('livroescolhido').value;
    var genero = document.getElementById('genero').value;
    var dataretirada = document.getElementById('dataretirada').value;
    var datadevolucao = document.getElementById('datadevolucao').value;
    var avarias = document.getElementById('avarias').value;

    fazerRequisicao(3, id, nomeleitor, emailleitor, cpf, livroescolhido, genero, dataretirada, datadevolucao, avarias);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('deletar').addEventListener('click', function(){
    var id = document.getElementById('id').value;

    fazerRequisicao(4, id, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
});

function fazerRequisicao(tipo, id, nomeleitor, emailleitor, cpf, livroescolhido, genero, dataretirada, datadevolucao, avarias) {
    var url = `http://localhost/projeto_front-end/back/data/procemprestimos.index.php?tipo=${tipo}&`;

    if (id !== undefined){
        url += `id=${id}&`;
    }
    if (nomeleitor !== undefined){
        url += `nomeleitor=${nomeleitor}&`;
    }
    if (emailleitor !== undefined){
        url += `emailleitor=${emailleitor}&`;
    }
    if (cpf !== undefined){
        url += `cpf=${cpf}&`;
    }
    if (livroescolhido !== undefined){
        url += `livroescolhido=${livroescolhido}&`;
    }
    if (genero !== undefined){
        url += `genero=${genero}&`;
    }
    if (dataretirada !== undefined){
        url += `dataretirada=${dataretirada}&`;
    }
    if (datadevolucao !== undefined){
        url += `datadevolucao=${datadevolucao}&`;
    }
    if (avarias !== undefined){
        url += `avarias=${avarias}&`;
    }

    fetch(url, {method: 'get'}).then(function(response){
        if (tipo == 2) {
           return response.json(); 
        }   
    }).then(function (data) {
        let procemprestimos = data;  
        let table = document.getElementsByTagName("table");
        let linhas = "";

        for (var i = 0; i < procemprestimos.length; i++) { 
            linhas += `tr> +
                        "<td>${procemprestimos[i].id}</td>" +
                        "<td>${procemprestimos[i].nomeleitor}</td>" +
                        "<td>${procemprestimos[i].emailleitor}</td>" +
                        "<td>${procemprestimos[i].cpf}</td>" +
                        "<td>${procemprestimos[i].livroescolhido}</td>" +
                        "<td>${procemprestimos[i].genero}</td>" +
                        "<td>${procemprestimos[i].dataretirada}</td>" +
                        "<td>${procemprestimos[i].datadevolucao}</td>" +
                        "<td>${procemprestimos[i].avarias}</td>` +
                      "</tr>";
        }

        table[0].innerHTML = ""
        table[0].innerHTML ="<tr>" +
        "<th>ID</th>" +
        "<th>Nome do Leitor</th>" +
        "<th>Email</th>" +
        "<th>CPF</th>" +
        "<th>Livro Escolhido</th>" +
        "<th>Gênero</th>" +
        "<th>Data de Retirada</th>" +
        "<th>Data de Devolução</th>" +
        "<th>Avarias</th>" +
        "</tr>" + linhas;
    })
    .catch(function(error){
        console.log(error);
    });

    document.getElementById('id').value= ""; 
    document.getElementById('nomeleitor').value = ""; 
    document.getElementById('emailleitor').value = ""; 
    document.getElementById('cpf').value = ""; 
    document.getElementById('livroescolhido').value = ""; 
    document.getElementById('genero').value = ""; 
    document.getElementById('dataretirada').value = ""; 
    document.getElementById('datadevolucao').value = ""; 
    document.getElementById('avarias').value = ""; 
}
