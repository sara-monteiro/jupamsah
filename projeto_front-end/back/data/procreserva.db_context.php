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
        

    // código para procreserva.index.php
    public function adicionar($nomeleitor, $emailleitor, $livroescolhido, $dataretirada, $datalimite) {
    $query = "INSERT INTO procreserva (nomeleitor, emailleitor, livroescolhido, dataretirada, datalimite) VALUES ('"
             . $this->conexao->real_escape_string($nomeleitor) . "', '"
             . $this->conexao->real_escape_string($emailleitor) . "', '"
             . $this->conexao->real_escape_string($livroescolhido) . "', '"
             . $this->conexao->real_escape_string($dataretirada) . "', '"
             . $this->conexao->real_escape_string($datalimite) . "')";

    return $this->executar_query_sql($query);
    }

    public function consultar() {
    $query = "SELECT * FROM procreserva ORDER BY id";
    return $this->executar_query_sql($query);
    }

    public function atualizar($id, $nomeleitor, $emailleitor, $livroescolhido, $dataretirada, $datalimite) {
    $query = "UPDATE procreserva SET 
              nomeleitor = '" . $this->conexao->real_escape_string($nomeleitor) . "', 
              emailleitor = '" . $this->conexao->real_escape_string($emailleitor) . "', 
              livroescolhido = '" . $this->conexao->real_escape_string($livroescolhido) . "', 
              dataretirada = '" . $this->conexao->real_escape_string($dataretirada) . "', 
              datalimite = '" . $this->conexao->real_escape_string($datalimite) . "' 
              WHERE id = " .  $id;

    return $this->executar_query_sql($query);
    }

    public function deletar($id) {     //deletar pela chave primária
    $query = "DELETE FROM procreserva WHERE id = " . $id;
    return $this->executar_query_sql($query);
    }

  
}

?>
