<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 11:34
 */
class OrdemDeServicoControl
{
    protected $con;
    protected $objOS;
    protected $osDAO;

    function __construct(OrdemDeServico $os= null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->osDAO = new OrdemDeServicoDAO($this->con);
        $this->objOS = $os;
    }

    function buscarPorId(){
        return $this->osDAO->buscarPorId($this->objOS);
    }

    function listarTodos(){
        return $this->osDAO->listarTodos();
    }

}