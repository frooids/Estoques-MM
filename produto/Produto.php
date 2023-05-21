<?php

include("bd/BancoDados.php");

class Produto {
    private $codigo;
    private $nome;
    private $categoria;
    private $valor;
    private $info;
    private $cod_usuario;

    function pegar_valores_post($valores){
        if(! isset($_SESSION["codigo_usuario"]))
         session_start();
        $this->codigo = isset($valores["cod_prod"]) ? $valores["cod_prod"] : 0;
        $this->nome = $valores["nome_produto"];
        $this->categoria = $valores["categoria_produto"];
        $this->valor = $valores["valor_produto"];
        $this->foto = $valores["foto_produto"];
        $this->info = $valores["info_produto"];
        $this->cod_usuario = $_SESSION["codigo_usuario"];
    }
    
    function selecionar($codigo = null){
        $where_cod =""; 
        if(isset($cod_prod) && $cod_prod > 0){
            $where_cod = " AND codigo = ".$codigo;
        }
    
        try{
            $bd = new BancoDados();
            $conn = $bd ->conectar();

            $consulta = $conn->prepare("SELECT * FROM produto WHERE situacao = 'HABILITADO'" . $where_cod);
            $consulta->execute();
            $resultado = $consulta->fetchAll();            
        }catch(PDOException $e) {     
            $resultado["msg"] = "Erro ao selecionar produtos do banco de dados: " . $e->getMessage();
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }
        $conn = null;

        return $resultado;
    }

    function inserir($produto){
        $this->pegar_valores_post($produto);
            try{
                $bd = new BancoDados();
                $conn = $bd ->conectar();

                $sql = "INSERT INTO produto (nome, categoria, valor, foto, info_adicional, codigo_usuario, situacao) VALUES (?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$this->nome, $this->categoria, $this->valor, $this->foto, $this->info, $this->cod_usuario, 'HABILITADO']);
                $resultado["msg"] = "Produto inserido";
                $resultado["cod"] = 1;
                $resultado["style"] = "alert-success";
            }catch (PDOException $e) {     
                $resultado["msg"] = "Erro ao inserir produto no banco de dados: ". $e->getMessage();
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
            }  
                $conn = null;
                
                return $resultado;
    }

    function atualizar($produto){
        $this->pegar_valores_post($produto);
        try{
            $bd = new BancoDados();
            $conn = $bd ->conectar();
        
            $sql = "UPDATE produto SET nome = ?, categoria = ?, valor = ?, info_adicional = ?, data_hora = now() WHERE codigo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->categoria, $this->valor, $this->info, $this->codigo]);
    
            $resultado["msg"] = "Item alterado com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
           }
           catch (PDOException $e) {     
            $resultado["msg"] = "Erro ao alterar produto no banco de dados: " . $e->getMessage();
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }  
        $conn = null;

        return $resultado;
    }

    function remover($codigo){
        try {
            $bd = new BancoDados();
            $conn = $bd ->conectar();
    
            $sql = "UPDATE produto SET situacao = 'DESABILITADO' WHERE codigo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$codigo]);
    
            $resultado["msg"] = "Item removido com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
    
        }catch (PDOException $e) {     
            $resultado["msg"] = "Erro ao remover produto no banco de dados: ";
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }  
        $conn = null;

        return $resultado;
    }
}
?>