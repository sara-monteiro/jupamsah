document.getElementById('cadastrar').addEventListener('click', function() {
 
    var titulo = document.getElementById('titulo').value; 
    var autor = document.getElementById('autor').value; 
    var genero = document.getElementById('genero').value; 
    var editora = document.getElementById('editora').value; 
    var anopublicacao = document.getElementById('anopublicacao').value; 
    var volume = document.getElementById('volume').value; 
    var quantidadepaginas = document.getElementById('quantidadepaginas').value; 
    var isbn = document.getElementById('isbn').value; 

    fazerRequisicao(1, undefined, titulo, autor, genero, editora, anopublicacao, volume, quantidadepaginas, isbn);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('listar').addEventListener('click', function(){
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);
});

document.getElementById('atualizar').addEventListener('click', function(){
    var id = document.getElementById('id').value; 
    var titulo = document.getElementById('titulo').value; 
    var autor = document.getElementById('autor').value; 
    var genero = document.getElementById('genero').value; 
    var editora = document.getElementById('editora').value; 
    var anopublicacao = document.getElementById('anopublicacao').value; 
    var volume = document.getElementById('volume').value; 
    var quantidadepaginas = document.getElementById('quantidadepaginas').value; 
    var isbn = document.getElementById('isbn').value; 

    fazerRequisicao(3, id, titulo, autor, genero, editora, anopublicacao, volume, quantidadepaginas, isbn);
    fazerRequisicao(2, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined, undefined);

});

document.getElementById('deletar').addEventListener('click', function(){
    var id = document.getElementById('id').value;

    fazerRequisicao(4, id, undefined, undefined, undefined,undefined, undefined, undefined, undefined, undefined);    // primary key
    fazerRequisicao(2, undefined, undefined, undefined, undefined,undefined, undefined, undefined, undefined, undefined);
});

function fazerRequisicao(tipo, id, titulo, autor, genero, editora, anopublicacao, volume, quantidadepaginas, isbn) {
    var url = `http://localhost/projeto_front-end/back/data/cadlivro.index.php?tipo=${tipo}&`;

    if (id !== undefined){
        url += `id=${id}&`;
    }
    if (titulo !== undefined){
        url += `titulo=${titulo}&`;
    }
    if (autor !== undefined){
        url += `autor=${autor}&`;
    }
    if (genero !== undefined){
        url += `genero=${genero}&`;
    }
    if (editora !== undefined){
        url += `editora=${editora}&`;
    }
    if (anopublicacao !== undefined){
        url += `anopublicacao=${anopublicacao}&`;
    }
    if (volume !== undefined){
        url += `volume=${volume}&`;
    }
    if (quantidadepaginas !== undefined){
        url += `quantidadepaginas=${quantidadepaginas}&`;
    }
    if (isbn !== undefined){
        url += `isbn=${isbn}&`;
    }

    fetch(url, {method: 'get'}).then(function(response){
        if (tipo == 2) {
           return response.json(); 
        }   
    }).then(function (data) {
        let cadlivro = data;  
        let table = document.getElementsByTagName("table");
        let linhas = "";

        for (var i = 0; i < cadlivro.length; i++) { 
            linhas += `<tr>` +
                        `<td>${cadlivro[i].id}</td>` +
                        `<td>${cadlivro[i].titulo}</td>` +
                        `<td>${cadlivro[i].autor}</td>` +
                        `<td>${cadlivro[i].genero}</td>` +
                        `<td>${cadlivro[i].editora}</td>` +
                        `<td>${cadlivro[i].anopublicacao}</td>` +
                        `<td>${cadlivro[i].volume}</td>` +
                        `<td>${cadlivro[i].quantidadepaginas}</td>` +
                        `<td>${cadlivro[i].isbn}</td>` +
                      `</tr>`;
        }

        table[0].innerHTML = "";
        table[0].innerHTML = `<tr>` +
        `<th>ID</th>` +
        `<th>Título</th>` +
        `<th>Autor</th>` +
        `<th>Gênero</th>` +
        `<th>Editora</th>` +
        `<th>Ano de Publicação</th>` +
        `<th>Volume</th>` +
        `<th>Quantidade de Páginas</th>` +
        `<th>ISBN</th>` +
        `</tr>` + linhas;
    })
    .catch(function(error){
        console.log(error);
    });


    //codigo para limpar os campos de entrada após a requisição.
    document.getElementById('id').value = ""; 
    document.getElementById('titulo').value = ""; 
    document.getElementById('autor').value = ""; 
    document.getElementById('genero').value = ""; 
    document.getElementById('editora').value = ""; 
    document.getElementById('anopublicacao').value = ""; 
    document.getElementById('volume').value = ""; 
    document.getElementById('quantidadepaginas').value = ""; 
    document.getElementById('isbn').value = ""; 
}
