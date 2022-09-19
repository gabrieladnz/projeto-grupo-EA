<?php

include("conexao_bd.php");

class Chamado
{
    private $codigo;
    private $nome;
    private $setor;
    private $grau;
    private $info;
    private $cod_usuario;

    function pegar_valores_post($valores)
    {
        if (!isset($_SESSION["codigo_usuario"])) session_start();

        $this->codigo = isset($valores["cod_cham"]) ? $valores["cod_cham"] : 0;
        $this->nome = $valores["nome_chamadoaberto"];
        $this->setor = $valores["setor_chamadoaberto"];
        $this->grau = $valores["grau_chamadoaberto"];
        $this->info = $valores["info_chamadoaberto"];
        $this->cod_usuario = $_SESSION["codigo_usuario"];
    }

    function selecionar($codigo = null)
    {
        $where_cod = "";
        if (isset($codigo) && $codigo > 0) {
            $where_cod = " AND codigo = " . $codigo;
        }

        try {

            include("conexao_bd.php");

            // Pegar os produtos armazenados no BD:
            $consulta = $conn->prepare("SELECT * FROM chamado WHERE situacao = 'HABILITADO'" . $where_cod);
            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (PDOException $e) {
            $resultado["msg"] = "Erro ao selecionar chamados no banco de dados." . $e->getMessage();
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;
        return $resultado;
    }

    function inserir($valores)
    {
        $this->pegar_valores_post($valores);

        try {

            include("conexao_bd.php");

            $sql = "INSERT INTO chamado (funcionario, setor, grau, info_adicional, codigo_usuario)
        VALUES (?,?,?,?,?)";

            $stmt = $conn->prepare($sql);
            //pegar o código do usuário logado
            $stmt->execute([$this->nome, $this->setor, $this->grau, $this->info, $this->cod_usuario]);

            $resultado["msg"] = "Chamado registrado.";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {
            $resultado["msg"] = "Erro ao inserir chamado no banco de dados." . $e->getMessage();
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;
        return $resultado;
    }

    function atualizar($chamado)
    {
        //$this->pegar_valores_post($chamado);
        try {

            include("conexao_bd.php");

            $sql = "UPDATE chamado SET funcionario = ?, setor = ?, grau = ?, info_adicional = ?
                    WHERE codigo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->setor, $this->grau, $this->info, $this->cod_cham]);

            $resultado["msg"] = "Chamado alterado com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {
            $resultado["msg"] = "Falha ao alterar chamado." . $e->getMessage();
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;
        return $resultado;
    }

    function remover($codigo)
    {
        try {

            include("conexao_bd.php");

            $sql = "UPDATE chamado SET situacao = 'DESABILITADO'
                    WHERE codigo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$codigo]);

            $resultado["msg"] = "Chamado removido com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {

            $resultado["msg"] = "Falha ao remover chamado." . $e->getMessage();
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;
        return $resultado;
    }
}
