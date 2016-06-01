<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:39
 */
class OsItensDeServicoControl
{
    protected $con;
    protected $objItem;
    protected $osDAO;

    function __construct(OsItensDeServico $item= null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->osDAO = new OsItensDeServicoDAO($this->con);
        $this->objItem = $item;
    }

    function cadastrar(){
        return $this->osDAO->cadastrar($this->objItem);
    }
    function listarPorIdOs($idos){
        return $this->osDAO->listarPorIdOs($idos);
    }

}