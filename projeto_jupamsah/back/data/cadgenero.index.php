<?php

header("Access-Control-Allow-Origin: *");

require("cadgenero.db_context.php");

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
        isset($_GET['genero']) && 
        isset($_GET['quantidade']) && 
        isset($_GET['datainclusao'])
    ) {
        $genero = $_GET['genero'];
        $quantidade = $_GET['quantidade'];
        $datainclusao = $_GET['datainclusao']; 

        $resultado = $db_context->adicionar($genero, $quantidade, $datainclusao);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros genero, quantidade ou datainclusao não indicados na requisição');
        echo json_encode($error);
    }
} else if ($tipo == 2) {
    $resultado = $db_context->consultar();
    echo json_encode($resultado);
} else if ($tipo == 3) {
    if (
        isset($_GET['id']) &&
        isset($_GET['genero']) && 
        isset($_GET['quantidade']) && 
        isset($_GET['datainclusao'])
    ) {
        $id = $_GET['id'];
        $genero = $_GET['genero'];
        $quantidade = $_GET['quantidade'];
        $datainclusao = $_GET['datainclusao']; 

        $resultado = $db_context->atualizar($id, $genero, $quantidade, $datainclusao);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros id, genero, quantidade ou datainclusao não indicados na requisição');
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
