<?php
if (count($_POST) > 0) {
    // Pegar os valores do forms
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    try {
        include("bd/BancoDados.php");
        $bd = new BancoDados();
        $conn = $bd ->conectar();

        // Verificar se email e senha estão corretos
        $consulta = $conn->prepare("SELECT * FROM usuario WHERE situacao='Habilitado' AND email=:email AND senha=md5(:senha)");
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
        $consulta->execute();
     
        $r = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $qtd_usuarios = count($r);
        if ($qtd_usuarios == 1) {
            session_start();
            $_SESSION["email_usuario"] = $email;
            $_SESSION["nome_usuario"] = $r[0]["nome"];
            $_SESSION["codigo_usuario"] = $r[0]["codigo"];

            header("Location: produto.php");
        } else if ($qtd_usuarios == 0) {
            $resultado["msg"] = "E-mail ou senha não conferem!";
            $resultado["cod"] = 0;
        }
    } catch (PDOException $e) {
        echo "Conexão falhou: " . $e->getMessage();
    }
    $conn = null;
}

include("index.php");
