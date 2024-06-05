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

    
    // codigo para cadlivro.index.php
    public function adicionar( $titulo, $autor, $genero, $editora, $anopublicacao, $volume, $quantidadepaginas, $isbn) {
        $query = "INSERT INTO cadlivro (titulo, autor, genero, editora, anopublicacao, volume, quantidadepaginas, isbn) VALUES ('"

            . $this->conexao->real_escape_string($titulo) . "', '"
            . $this->conexao->real_escape_string($autor) . "', '"
            . $this->conexao->real_escape_string($genero) . "', '"
            . $this->conexao->real_escape_string($editora) . "', '"
            . $this->conexao->real_escape_string($anopublicacao) . "', '"
            . $this->conexao->real_escape_string($volume) . "', '"
            . $this->conexao->real_escape_string($quantidadepaginas) . "', '"
            . $this->conexao->real_escape_string($isbn) . "')";
    
        return $this->executar_query_sql($query);
    }
    
    public function consultar() {
        $query = "SELECT * FROM cadlivro ORDER BY id";
        return $this->executar_query_sql($query);
    }
    
    public function atualizar($id, $titulo, $autor, $genero, $editora, $anopublicacao, $volume, $quantidadepaginas, $isbn) {
        $query = "UPDATE cadlivro SET 
                  titulo = '" . $this->conexao->real_escape_string($titulo) . "', 
                  autor = '" . $this->conexao->real_escape_string($autor) . "', 
                  genero = '" . $this->conexao->real_escape_string($genero) . "', 
                  editora = '" . $this->conexao->real_escape_string($editora) . "', 
                  anopublicacao = '" . $this->conexao->real_escape_string($anopublicacao) . "', 
                  volume = '" . $this->conexao->real_escape_string($volume) . "', 
                  quantidadepaginas = '" . $this->conexao->real_escape_string($quantidadepaginas) . "', 
                  isbn = '" . $this->conexao->real_escape_string($isbn) . "' 
                  WHERE id = " . $id;
    
        return $this->executar_query_sql($query);
    }
    
    public function deletar($id) {
        $query = "DELETE FROM cadlivro WHERE id = " . $id;
        return $this->executar_query_sql($query);
    }
    
}

?>
