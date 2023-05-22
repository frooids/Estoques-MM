<?php
class BancoDados{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct(){
        $url = parse_url("mysql://b42b7bec78b941:5f3d5edc@us-cdbr-east-06.cleardb.net/heroku_ef57a694d65daea?reconnect=true");
        $this->servername = $url["host"]; // Host do banco de dados
        $this->username = $url["user"]; // Nome de usuário do banco de dados
        $this->password = $url["pass"]; // Senha do banco de dados
        $this->dbname = substr($url["path"], 1);
    }
        
    public function conectar(){
        $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
?>