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

        if (!$resultado) {
            $error = array('error' => $this->conexao->error);
            return json_encode($error);
        }

        if ($resultado->num_rows > 0) {
            $linhas = array();
            while ($linha = $resultado->fetch_assoc()){
                $linhas[] = $linha;
            }
            return json_encode($linhas);
        }

        return json_encode($resultado);
    }
        

     // codigo para cadadmin.index.php
    public function adicionar ($nome, $email, $cpf, $matricula, $cargo, $localtrabalho, $senha) {
        $query = "INSERT INTO cadadmin (nome, email, cpf, matricula, cargo, localtrabalho, senha) VALUES ('"
        . $this->conexao->real_escape_string($nome) . "', '"
        . $this->conexao->real_escape_string($email) . "', '"
        . $this->conexao->real_escape_string($cpf) . "', '"
        . $this->conexao->real_escape_string($matricula) . "', '"
        . $this->conexao->real_escape_string($cargo) . "', '"
        . $this->conexao->real_escape_string($localtrabalho) . "', '"
        . $this->conexao->real_escape_string($senha) . "')";

        return $this->executar_query_sql($query);
        echo $query;
    }
    

    public function consultar() {
        $query = "SELECT * FROM cadadmin ORDER BY id";
        return $this->executar_query_sql($query);
    }

   
    public function atualizar($id, $nome, $email, $cpf, $matricula, $cargo, $localtrabalho, $senha) {
        $query = "UPDATE cadadmin SET 
                  nome = '" . $this->conexao->real_escape_string($nome) . "', 
                  email = '" . $this->conexao->real_escape_string($email) . "', 
                  cpf = '" . $this->conexao->real_escape_string($cpf) . "', 
                  matricula = '" . $this->conexao->real_escape_string($matricula) . "', 
                  cargo = '" . $this->conexao->real_escape_string($cargo) . "', 
                  localtrabalho = '" . $this->conexao->real_escape_string($localtrabalho) . "', 
                  senha = '" . $this->conexao->real_escape_string($senha) . "' 
                  WHERE id = " .  $id;
    
        return $this->executar_query_sql($query);
    }

    public function deletar($id) {     //deletar pela chave primária
        $query = "DELETE FROM cadadmin WHERE id = " . $id;
        return $this->executar_query_sql($query);
    }
  
}

?>