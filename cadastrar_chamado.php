<?php
if (count($_POST) > 0) {
    session_start();
    // pegando os valores do formulário
    $nome = $_POST["nome_setor"];
    $grau = $_POST["grau_setor"];
    $desc = $_POST["desc_setor"];
    $cod_usuario = $_SESSION["codigo_usuario"];
    // pegar o código do usuário logado

    try {

        include("conexao_bd.php");

        // 3- verificar se o email e senha estão no BD
        $sql = "INSERT INTO chamado_abert (cod_usuario, nome_setor, descricao, grau) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        //pegar o código do usuário logado
        $stmt->execute([$cod_usuario, $nome, $desc, $grau]);

        $resultado["msg"] = "Chamado aberto!";
        $resultado["cod"] = 1;
        $resultado["style"] = "alert-success";
    } catch (PDOException $e) {
        $resultado["msg"] = "Solicitação falhou." . $e->getMessage();
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }

    $conn = null;
}
include("chamado.php");
