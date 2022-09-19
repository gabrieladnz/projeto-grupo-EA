<?php
require_once("Chamado.php");
class ChamadoController
{
    private $chamado;
    function __construct()
    {
        $this->chamado = new Chamado();
    }

    function selecionar($codigo = null)
    {
        return $this->chamado->selecionar($codigo);
    }

    function cadastrar($valores)
    {
        $resultado = $this->chamado->inserir($valores);
        //include("chamadoaberto.php");
    }
}
