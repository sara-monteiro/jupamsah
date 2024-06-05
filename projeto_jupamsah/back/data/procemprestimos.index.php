<?php

header("Access-Control-Allow-Origin: *");

require("procemprestimos.db_context.php");

$tipo = 0;

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
} else {
    $error = array('error' => 'Parâmetro TIPO não indicado na requisição');
    echo json_encode($error);
    exit();
}

$db_context = new DbContext();

$db_context->conectar();

if ($tipo == 1) {
    if (
        isset($_GET['nomeleitor']) && isset($_GET['emailleitor']) && isset($_GET['cpf']) && isset($_GET['livroescolhido'])
        && isset($_GET['genero']) && isset($_GET['dataretirada']) && isset($_GET['datadevolucao']) && isset($_GET['avarias'])
    ) {
        $nomeleitor = $_GET['nomeleitor'];
        $emailleitor = $_GET['emailleitor'];
        $cpf = $_GET['cpf'];
        $livroescolhido = $_GET['livroescolhido'];
        $genero = $_GET['genero'];
        $dataretirada = $_GET['dataretirada'];
        $datadevolucao = $_GET['datadevolucao'];
        $avarias = $_GET['avarias'];

        $resultado = $db_context->adicionar($nomeleitor, $emailleitor, $cpf, $livroescolhido, $genero, $dataretirada, $datadevolucao, $avarias);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros não indicados corretamente na requisição');
        echo json_encode($error);
    }
} else if ($tipo == 2) {
    $resultado = $db_context->consultar();
    echo json_encode($resultado);
} else if ($tipo == 3) {

    if (
        isset($_GET['id']) && isset($_GET['nomeleitor']) && isset($_GET['emailleitor']) && isset($_GET['cpf']) &&
        isset($_GET['livroescolhido']) && isset($_GET['genero']) && isset($_GET['dataretirada']) &&
        isset($_GET['datadevolucao']) && isset($_GET['avarias'])
    ) {
        $id = $_GET['id'];
        $nomeleitor = $_GET['nomeleitor'];
        $emailleitor = $_GET['emailleitor'];
        $cpf = $_GET['cpf'];
        $livroescolhido = $_GET['livroescolhido'];
        $genero = $_GET['genero'];
        $dataretirada = $_GET['dataretirada'];
        $datadevolucao = $_GET['datadevolucao'];
        $avarias = $_GET['avarias'];

        $resultado = $db_context->atualizar($id, $nomeleitor, $emailleitor, $cpf, $livroescolhido, $genero, $dataretirada, $datadevolucao, $avarias);
        echo $resultado;
    } else {
        $error = array('error' => 'Parâmetros não indicados corretamente na requisição');
        echo json_encode($error);
    }
} else if ($tipo == 4) {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $resultado = $db_context->deletar($id);
        echo json_encode($resultado);
    } else {
        $error = array('error' => 'Parâmetro ID não indicado na requisição');
        echo json_encode($error);
    }
}

$db_context->desconectar();

?>
