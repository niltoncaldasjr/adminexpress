<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:39
 */
class OsChecklistControl
{
    protected $con;
    protected $objChk;
    protected $osDAO;

    function __construct(OsChecklist $chk= null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->osDAO = new OsChecklistDAO($this->con);
        $this->objChk = $chk;
    }

    function cadastrar(){
        return $this->osDAO->cadastrar($this->objChk);
    }
    function listarPorIdOs($idos){
        return $this->osDAO->listarPorIdOs($idos);
    }

}