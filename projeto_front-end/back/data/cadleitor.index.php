<?php

header("Access-Control-Allow-Origin: *");

require("cadleitor.db_context.php");

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
        isset($_GET['cpf']) && 
        isset($_GET['datanascimento']) && 
        isset($_GET['enderecocompleto'])
    ) {
        $nomeleitor = $_GET['nomeleitor'];
        $emailleitor = $_GET['emailleitor'];
        $cpf = $_GET['cpf'];
        $datanascimento = $_GET['datanascimento']; 
        $enderecocompleto = $_GET['enderecocompleto'];

        $resultado = $db_context->adicionar($nomeleitor, $emailleitor, $cpf, $datanascimento, $enderecocompleto);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros nomeleitor, emailleitor, cpf, datanascimento ou enderecocompleto não indicados na requisição');
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
        isset($_GET['cpf']) && 
        isset($_GET['datanascimento']) && 
        isset($_GET['enderecocompleto'])
    ) {
        $id = $_GET['id'];
        $nomeleitor = $_GET['nomeleitor'];
        $emailleitor = $_GET['emailleitor'];
        $cpf = $_GET['cpf'];
        $datanascimento = $_GET['datanascimento']; 
        $enderecocompleto = $_GET['enderecocompleto'];

        $resultado = $db_context->atualizar($id, $nomeleitor, $emailleitor, $cpf, $datanascimento, $enderecocompleto);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros id, nomeleitor, emailleitor, cpf, datanascimento ou enderecocompleto não indicados na requisição');
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
