<?php //NAO MEXER MAIS
//session_start();
//print_r($_SESSION);
//exit;

//if (isset($_SESSION["codigo_usuario"]) && $_SESSION["codigo_usuario" > 0]) {

if (count($_GET) > 0) {

    $cod_cham = $_GET["cod_cham"];
    require_once('chamado/Chamado.php');

    $chamado = new Chamado();
    $resultado = $chamado->remover($cod_cham);

    echo json_encode($resultado);
}
//} else {
//    echo "Operação não permitida.";
//}
