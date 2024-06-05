<?php

header("Access-Control-Allow-Origin: *");

require("procreserva.db_context.php");

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
        isset($_GET['nomeleitor']) && 
        isset($_GET['emailleitor']) && 
        isset($_GET['livroescolhido']) && 
        isset($_GET['dataretirada']) && 
        isset($_GET['datalimite'])
    ) {
        $nomeleitor = $_GET['nomeleitor'];
        $emailleitor = $_GET['emailleitor'];
        $livroescolhido = $_GET['livroescolhido'];
        $dataretirada = $_GET['dataretirada']; 
        $datalimite = $_GET['datalimite'];

        $resultado = $db_context->adicionar($nomeleitor, $emailleitor, $livroescolhido, $dataretirada, $datalimite);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetro nomeleitor, emailleitor, livroescolhido, dataretirada ou datalimite não indicados na requisição');
        echo json_encode($error);
    }
} else if ($tipo == 2) {
    $resultado = $db_context->consultar();
    echo json_encode($resultado);
    
} else if ($tipo == 3) {
    if (
        isset($_GET['id']) &&
        isset($_GET['nomeleitor']) && 
        isset($_GET['emailleitor']) && 
        isset($_GET['livroescolhido']) && 
        isset($_GET['dataretirada']) && 
        isset($_GET['datalimite'])
    ) {
        $id = $_GET['id'];
        $nomeleitor = $_GET['nomeleitor'];
        $emailleitor = $_GET['emailleitor'];
        $livroescolhido = $_GET['livroescolhido'];
        $dataretirada = $_GET['dataretirada']; 
        $datalimite = $_GET['datalimite'];

        $resultado = $db_context->atualizar($id, $nomeleitor, $emailleitor, $livroescolhido, $dataretirada, $datalimite);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros id, nomeleitor, emailleitor, livroescolhido, dataretirada ou datalimite não indicados na requisição');
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
