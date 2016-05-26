<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 10:52
 */
class OrdemDeServicoDAO
{
    private $con;
    private $sql;
    private $obj;
    private $lista = array();
    //testando
    function __construct($con){
        $this->con = $con;
    }

    function listarTodos()
    {
//        $array = array();
        $query = "SELECT * FROM ordemdeservico";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_object($result)){
            $pControl = new PessoaControl();
            $row->idcliente = $pControl->listarJuntosPorId($row->idcliente);

            $s = new Servico($row->idservico);
            $sControl = new ServicoControl($s);
            $row->idservico = $sControl->buscarPorId();

            $this->lista[] = $row;
        }
        return $this->lista;
    }

    function buscarPorId(OrdemDeServico $os)
    {
        $query = sprintf("SELECT * FROM ordemdeservico WHERE id = %d",
            mysqli_real_escape_string($this->con, $os->getId())
        );
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_object($result)){
            $this->obj = $row;
        }
        return $this->obj;
    }
}