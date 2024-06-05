<?php

require_once("config.php");

class DbContext {
    private $host;
    private $usuario;
    private $senha;
    private $dbname;
    private $porta;

    private $conexao;

    public function __construct() {
        $this->host = MYSQL_DB_HOST;
        $this->usuario = MYSQL_DB_USERNAME;
        $this->senha = MYSQL_DB_PASSWORD;
        $this->dbname = MYSQL_DB_DATABASE;
        $this->porta = MYSQL_DB_PORT;
    }
    
    public function conectar() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha,  $this->dbname, $this->porta);

        if ($this->conexao->connect_error) {
            die("Conexão Falhou:" . $this->conexao->connect_error);
        }
    }

    public function desconectar() {
        $this->conexao->close();
    }

    private function executar_query_sql($query) {
        $resultado = $this->conexao->query($query);

        if(!$resultado) {
            $error = array('error' => $this->conexao->error);
            return json_encode($error);
        }

        if($resultado->num_rows > 0) {
            $linhas = array();
            while ($linha = $resultado->fetch_assoc()){
                $linhas[] = $linha;
            }
            return json_encode($linhas);
        }

        return json_encode($resultado);
    }
        
    //  codigo para cadgenro.index.php
    public function adicionar( $genero, $quantidade, $datainclusao) {
        $query = "INSERT INTO cadgenero (genero, quantidade, datainclusao) VALUES ('"

            . $this->conexao->real_escape_string($genero) . "', '"
            . $this->conexao->real_escape_string($quantidade) . "', '"
            . $this->conexao->real_escape_string($datainclusao) . "')";
    
        return $this->executar_query_sql($query);
    }
    
    public function consultar() {
        $query = "SELECT * FROM cadgenero ORDER BY id";
        return $this->executar_query_sql($query);
    }
    
    public function atualizar($id, $genero, $quantidade, $datainclusao) {
        $query = "UPDATE cadgenero SET 
                  genero = '" . $this->conexao->real_escape_string($genero) . "', 
                  quantidade = '" . $this->conexao->real_escape_string($quantidade) . "', 
                  datainclusao = '" . $this->conexao->real_escape_string($datainclusao) . "' 
                  WHERE id = " . $id;
    
        return $this->executar_query_sql($query);
    }
    
    public function deletar($id) {
        $query = "DELETE FROM cadgenero WHERE id = " . $id;
        return $this->executar_query_sql($query);
    }
    
}

?>