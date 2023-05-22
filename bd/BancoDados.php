<?php
class BancoDados{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct(){
        $url = parse_url("mysql://b1370622adcbd7:f853f498@us-cdbr-east-06.cleardb.net/heroku_eb9ee63e9f599d0?reconnect=true");
        $this->servername = $url["host"]; // Host do banco de dados
        $this->username = $url["user"]; // Nome de usuário do banco de dados
        $this->password = $url["pass"]; // Senha do banco de dados
        $this->dbname = 'heroku_eb9ee63e9f599d0';
    }
        
    public function conectar(){
        $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
?>