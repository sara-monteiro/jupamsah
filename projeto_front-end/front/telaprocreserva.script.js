document.getElementById('cadastrar').addEventListener('click', function() {

    var nomeleitor = document.getElementById('nomeleitor').value; 
    var emailleitor = document.getElementById('emailleitor').value; 
    var livroescolhido = document.getElementById('livroescolhido').value;
    var dataretirada = document.getElementById('dataretirada').value;
    var datalimite = document.getElementById('datalimite').value;

    fazerRequisicao(1, undefined, nomeleitor, emailleitor, livroescolhido, dataretirada, datalimite);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('listar').addEventListener('click', function(){
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
});

document.getElementById('atualizar').addEventListener('click', function(){
    var id = document.getElementById('id').value; 
    var nomeleitor = document.getElementById('nomeleitor').value; 
    var emailleitor = document.getElementById('emailleitor').value; 
    var livroescolhido = document.getElementById('livroescolhido').value;
    var dataretirada = document.getElementById('dataretirada').value;
    var datalimite = document.getElementById('datalimite').value;

    fazerRequisicao(3, id, nomeleitor, emailleitor, livroescolhido, dataretirada, datalimite);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('deletar').addEventListener('click', function(){
    var id = document.getElementById('id').value;

    fazerRequisicao(4, id, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
});

function fazerRequisicao(tipo, id, nomeleitor, emailleitor, livroescolhido, dataretirada, datalimite) {
    var url = `http://localhost/projeto_front-end/back/data/procreserva.index.php?tipo=${tipo}&`;

    if (id !== undefined){
        url += `id=${id}&`;
    }
    if (nomeleitor !== undefined){
        url += `nomeleitor=${nomeleitor}&`;
    }
    if (emailleitor !== undefined){
        url += `emailleitor=${emailleitor}&`;
    }
    if (livroescolhido !== undefined){
        url += `livroescolhido=${livroescolhido}&`;
    }
    if (dataretirada !== undefined){
        url += `dataretirada=${dataretirada}&`;
    }
    if (datalimite !== undefined){
        url += `datalimite=${datalimite}&`;
    }

    fetch(url, {method: 'get'}).then(function(response){
        if (tipo == 2) {
           return response.json(); 
        }   
    }).then(function (data) {
        let procreserva = data;  
        let table = document.getElementsByTagName("table");
        let linhas = "";

        for (var i = 0; i < procreserva.length; i++) { 
            linhas += `<tr>` +
                        `<td>${procreserva[i].id}</td>` +
                        `<td>${procreserva[i].nomeleitor}</td>`+ 
                        `<td>${procreserva[i].emailleitor}</td>` +
                        `<td>${procreserva[i].livroescolhido}</td>`+ 
                        `<td>${procreserva[i].dataretirada}</td>` +
                        `<td>${procreserva[i].datalimite}</td>`+ 
                      `</tr>`;
        }

        table[0].innerHTML = "";
        table[0].innerHTML = `<tr>` +
        `<th>ID</th>` +
        `<th>Nome do Leitor</th>` +
        `<th>Email</th>` +
        `<th>Livro Escolhido</th>`+ 
        `<th>Data de Retirada</th>`+ 
        `<th>Data Limite</th>` +
        `</tr>` + linhas;
    })
    .catch(function(error){
        console.log(error);
    });

    document.getElementById('id').value = ""; 
    document.getElementById('nomeleitor').value = ""; 
    document.getElementById('emailleitor').value = ""; 
    document.getElementById('livroescolhido').value = ""; 
    document.getElementById('dataretirada').value = ""; 
    document.getElementById('datalimite').value = ""; 
}
