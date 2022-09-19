<?php
if (count($_POST) > 0) {
    // 1- pegar os valores do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    try {
        
        include("conexao_bd.php");

        // 3- verificar se o email e senha estão no BD
        $consulta = $conn->prepare("SELECT * FROM usuario WHERE situacao='HABILITADO' AND email=:email AND senha=md5(:senha)");
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
        // executa a consulta
        $consulta->execute();

        // Armazena e imprime a variável(email e senha)
        $r = $consulta->fetchAll();
        $qtd_usuarios = count($r);
        if ($qtd_usuarios == 1) {

            session_start();
            $_SESSION["email_usuario"] = $email;
            $_SESSION["nome_usuario"] = $r[0]["nome"];
            $_SESSION["codigo_usuario"] = $r[0]["codigo"];

            header("Location: chamadoaberto.php");

        } else if ($qtd_usuarios == 0) {
            $resultado["msg"] = "E-mail e senha não conferem.";
            $resultado["cod"] = 0;

        }

    } catch (PDOException $e) {
        echo "Conexão falhou." . $e->getMessage();
    }
    // fecha a conexão com o BD
    $conn = null;
}

include("index.php");
