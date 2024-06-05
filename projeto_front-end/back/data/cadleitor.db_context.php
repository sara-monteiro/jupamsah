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

     // codigo para cadleitor.index.php
    public function adicionar($nomeleitor, $emailleitor, $cpf, $datanascimento, $enderecocompleto) {
        $query = "INSERT INTO cadleitor (nomeleitor, emailleitor, cpf, datanascimento, enderecocompleto) VALUES ('"

            . $this->conexao->real_escape_string($nomeleitor) . "', '"
            . $this->conexao->real_escape_string($emailleitor) . "', '"
            . $this->conexao->real_escape_string($cpf) . "', '"
            . $this->conexao->real_escape_string($datanascimento) . "', '"
            . $this->conexao->real_escape_string($enderecocompleto) . "')";
    
        return $this->executar_query_sql($query);
    }
    
    public function consultar() {
        $query = "SELECT * FROM cadleitor ORDER BY id";
        return $this->executar_query_sql($query);
    }
    
    public function atualizar($id, $nomeleitor, $emailleitor, $cpf, $datanascimento, $enderecocompleto) {
        $query = "UPDATE cadleitor SET 
                  nomeleitor = '" . $this->conexao->real_escape_string($nomeleitor) . "', 
                  emailleitor = '" . $this->conexao->real_escape_string($emailleitor) . "', 
                  cpf = '" . $this->conexao->real_escape_string($cpf) . "', 
                  datanascimento = '" . $this->conexao->real_escape_string($datanascimento) . "', 
                  enderecocompleto = '" . $this->conexao->real_escape_string($enderecocompleto) . "' 
                  WHERE id = " . $id;
    
        return $this->executar_query_sql($query);
    }
    
    public function deletar($id) {
        $query = "DELETE FROM cadleitor WHERE $id = " . $id;
        return $this->executar_query_sql($query);
    }

    
}

?>