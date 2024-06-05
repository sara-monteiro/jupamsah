<?php

header("Access-Control-Allow-Origin: *");

require("cadadmin.db_context.php");

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
        isset($_GET['nome']) && 
        isset($_GET['email']) && 
        isset($_GET['cpf']) && 
        isset($_GET['matricula']) && 
        isset($_GET['cargo']) && 
        isset($_GET['localtrabalho']) && 
        isset($_GET['senha'])
    ) {
        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $cpf = $_GET['cpf'];
        $matricula = $_GET['matricula']; 
        $cargo = $_GET['cargo'];
        $localtrabalho = $_GET['localtrabalho'];
        $senha = $_GET['senha'];

        $resultado = $db_context->adicionar($nome, $email, $cpf, $matricula, $cargo, $localtrabalho, $senha);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros nome, email, cpf, matricula, cargo, localtrabalho ou senha não indicados na requisição');
        echo json_encode($error);
    }
} else if ($tipo == 2) {
    $resultado = $db_context->consultar();
    echo json_encode($resultado);
} else if ($tipo == 3) {
    if (
        isset($_GET['id']) &&
        isset($_GET['nome']) && 
        isset($_GET['email']) && 
        isset($_GET['cpf']) && 
        isset($_GET['matricula']) && 
        isset($_GET['cargo']) && 
        isset($_GET['localtrabalho']) && 
        isset($_GET['senha'])
    ) {
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $cpf = $_GET['cpf'];
        $matricula = $_GET['matricula']; 
        $cargo = $_GET['cargo'];
        $localtrabalho = $_GET['localtrabalho'];
        $senha = $_GET['senha'];

        $resultado = $db_context->atualizar($id, $nome, $email, $cpf, $matricula, $cargo, $localtrabalho, $senha);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros id, nome, email, cpf, matricula, cargo, localtrabalho ou senha não indicados na requisição');
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
