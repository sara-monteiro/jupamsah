document.getElementById('cadastrar').addEventListener('click', function() {

    var genero = document.getElementById('genero').value; 
    var quantidade = document.getElementById('quantidade').value; 
    var datainclusao = document.getElementById('datainclusao').value;

    fazerRequisicao(1, undefined, genero, quantidade, datainclusao);
    fazerRequisicao(2, undefined, undefined, undefined, undefined);

});

document.getElementById('listar').addEventListener('click', function(){
    fazerRequisicao(2, undefined, undefined, undefined, undefined);
});

document.getElementById('atualizar').addEventListener('click', function(){
    var id = document.getElementById('id').value; 
    var genero = document.getElementById('genero').value; 
    var quantidade = document.getElementById('quantidade').value; 
    var datainclusao = document.getElementById('datainclusao').value;

    fazerRequisicao(3, id, genero, quantidade, datainclusao);
    fazerRequisicao(2, undefined, undefined, undefined, undefined);

});

document.getElementById('deletar').addEventListener('click', function(){
    var id = document.getElementById('id').value;

    fazerRequisicao(4, id, undefined, undefined, undefined);
    fazerRequisicao(2, undefined, undefined, undefined, undefined);
});

function fazerRequisicao(tipo, id, genero, quantidade, datainclusao) {
    var url = `http://localhost/projeto_front-end/back/data/cadgenero.index.php?tipo=${tipo}&`;

    if (id !== undefined){
        url += `id=${id}&`;
    }
    if (genero !== undefined){
        url += `genero=${genero}&`;
    }
    if (quantidade !== undefined){
        url += `quantidade=${quantidade}&`;
    }
    if (datainclusao !== undefined){
        url += `datainclusao=${datainclusao}&`;
    }

    fetch(url, {method: 'get'}).then(function(response){
        if (tipo == 2) {
           return response.json(); 
        }   
    }).then(function (data) {
        let cadgenero = data;  
        let table = document.getElementsByTagName("table");
        let linhas = "";

        for (var i = 0; i < cadgenero.length; i++) { 
            linhas += `<tr>` +
                        `<td>${cadgenero[i].id}</td>` +
                        `<td>${cadgenero[i].genero}</td>`+ 
                        `<td>${cadgenero[i].quantidade}</td>` +
                        `<td>${cadgenero[i].datainclusao}</td>` +
                      `</tr>`;
        }

        table[0].innerHTML = "";
        table[0].innerHTML = `<tr>` +
        `<th>ID</th>` +
        `<th>Gênero</th>` +
        `<th>Quantidade</th>` +
        `<th>Data de Inclusão</th>` +
        `</tr>` + linhas;
    })
    .catch(function(error){
        console.log(error);
    });

    document.getElementById('id').value = ""; 
    document.getElementById('genero').value = ""; 
    document.getElementById('quantidade').value = ""; 
    document.getElementById('datainclusao').value = ""; 
}
