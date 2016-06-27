<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:39
 */
class ItensDeOrcamentoControl
{
    protected $con;
    protected $objItem;
    protected $orcDAO;

    function __construct(ItensDeOrcamento $item= null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->orcDAO = new ItensDeOrcamentoDAO($this->con);
        $this->objItem = $item;
    }

    function cadastrar(){
        return $this->orcDAO->cadastrar($this->objItem);
    }
    function atualizar(){
        return $this->orcDAO->atualizar($this->objItem);
    }
    function listarPorIdOrcamento($idorcamento){
        return $this->orcDAO->listarPorIdOrcamento($idorcamento);
    }

}