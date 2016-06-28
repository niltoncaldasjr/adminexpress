<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:39
 */
class OsParticipantesControl
{
    protected $con;
    protected $objPart;
    protected $osDAO;

    function __construct(OsParticipantes $part= null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->osDAO = new OsParticipantesDAO($this->con);
        $this->objPart = $part;
    }

    function cadastrar(){
        return $this->osDAO->cadastrar($this->objPart);
    }
    function atualizar(){
        return $this->osDAO->atualizar($this->objPart);
    }
    function listarPorIdOs($idos){
        return $this->osDAO->listarPorIdOs($idos);
    }

}