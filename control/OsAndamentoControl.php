<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:39
 */
class OsAndamentoControl
{
    protected $con;
    protected $objAnd;
    protected $osDAO;

    function __construct(OsAndamento $andam= null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->osDAO = new OsAndamentoDAO($this->con);
        $this->objAnd = $andam;
    }

    function cadastrar(){
        return $this->osDAO->cadastrar($this->objAnd);
    }
    function listarPorIdOs($idos){
        return $this->osDAO->listarPorIdOs($idos);
    }

}