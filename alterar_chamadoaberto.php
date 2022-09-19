<?php
if (count($_POST) > 0) {
    require_once('chamado/Chamado.php');

    $chamado = new Chamado();
    $resultado = $chamado->atualizar($_POST);

    header("location: chamadoaberto.php");
}
