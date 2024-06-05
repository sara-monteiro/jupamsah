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
    }
    // Obter os dados enviados pelo formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados para verificar se o email e a senha estão corretos
    $sql = "SELECT * FROM cadadmin WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    echo "Login bem-sucedido!";
    }   else {
    echo "Email ou senha incorretos!";
    }

?>