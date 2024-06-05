<?php

header("Access-Control-Allow-Origin: *");

require("cadlivro.db_context.php");

$tipo = 0;

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
} else {
    $error = array('error' => 'Parâmetro TIPO não indicado na requisição');
    echo json_encode($error);
    exit; // Encerra a execução do script após enviar o erro
}

$db_context = new DbContext();

$db_context->conectar();

if ($tipo == 1) {
    if (
        isset($_GET['titulo']) && 
        isset($_GET['autor']) && 
        isset($_GET['genero']) && 
        isset($_GET['editora']) && 
        isset($_GET['anopublicacao']) && 
        isset($_GET['volume']) && 
        isset($_GET['quantidadepaginas']) && 
        isset($_GET['isbn'])
    ) {
        $titulo = $_GET['titulo'];
        $autor = $_GET['autor'];
        $genero = $_GET['genero'];
        $editora = $_GET['editora']; 
        $anopublicacao = $_GET['anopublicacao'];
        $volume = $_GET['volume'];
        $quantidadepaginas = $_GET['quantidadepaginas'];
        $isbn = $_GET['isbn'];

        $resultado = $db_context->adicionar($titulo, $autor, $genero, $editora, $anopublicacao, $volume, $quantidadepaginas, $isbn);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros titulo, autor, genero, editora, anopublicacao, volume, quantidadepaginas ou isbn não indicados na requisição');
        echo json_encode($error);
    }
} else if ($tipo == 2) {
    $resultado = $db_context->consultar();
    echo json_encode($resultado);
} else if ($tipo == 3) {
    if (
        isset($_GET['id']) &&
        isset($_GET['titulo']) && 
        isset($_GET['autor']) && 
        isset($_GET['genero']) && 
        isset($_GET['editora']) && 
        isset($_GET['anopublicacao']) && 
        isset($_GET['volume']) && 
        isset($_GET['quantidadepaginas']) && 
        isset($_GET['isbn'])
    ) {
        $id = $_GET['id'];
        $titulo = $_GET['titulo'];
        $autor = $_GET['autor'];
        $genero = $_GET['genero'];
        $editora = $_GET['editora']; 
        $anopublicacao = $_GET['anopublicacao'];
        $volume = $_GET['volume'];
        $quantidadepaginas = $_GET['quantidadepaginas'];
        $isbn = $_GET['isbn'];

        $resultado = $db_context->atualizar($id, $titulo, $autor, $genero, $editora, $anopublicacao, $volume, $quantidadepaginas, $isbn);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros id, titulo, autor, genero, editora, anopublicacao, volume, quantidadepaginas ou isbn não indicados na requisição');
        echo json_encode($error);
    }
} else if ($tipo == 4) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $resultado = $db_context->deletar($id);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetro ID não indicado na requisição');
        echo json_encode($error);
    }
}

$db_context->desconectar();
