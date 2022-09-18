<?php

// 1- pegar os valores do formulário
$email = $_POST["email"];
$senha = $_POST["senha"];
// 2- conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "Admin01";

try {
    $conn = new PDO("mysql:host=$servername;dbname=empresa_bd", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexão realizada com sucesso.";
    $stmt = $conn->prepare("SELECT codigo FROM usuario WHERE email=:email AND senha=:senha");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
        echo $v;
    }
} catch (PDOException $e) {
    echo "Conexão falhou." . $e->getMessage();
}
// fecha a conexão com o BD
$conn = null;
    // 3- verificar se o email e senha estão no BD
