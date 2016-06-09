<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 09/06/2016
 * Time: 17:45
 */
class OsAndamento
{
    private $id;
    private $descricao;
    private $objOrdemdeservico;
    private $objStatusprocesso;
    private $datacadastro;

    /**
     * OsAndamento constructor.
     * @param $id
     * @param $descricao
     * @param $objOrdemdeservico
     * @param $objStatusprocesso
     */
    public function __construct($id=NULL, $descricao=NULL, OrdemDeServico $objOrdemdeservico=NULL, StatusProcesso $objStatusprocesso=NULL)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->objOrdemdeservico = $objOrdemdeservico;
        $this->objStatusprocesso = $objStatusprocesso;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     * @return OsAndamento
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param null $descricao
     * @return OsAndamento
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return OrdemDeServico
     */
    public function getObjOrdemdeservico()
    {
        return $this->objOrdemdeservico;
    }

    /**
     * @param OrdemDeServico $objOrdemdeservico
     * @return OsAndamento
     */
    public function setObjOrdemdeservico($objOrdemdeservico)
    {
        $this->objOrdemdeservico = $objOrdemdeservico;
        return $this;
    }
       

    /**
     * @return StatusProcesso
     */
    public function getObjStatusprocesso()
    {
        return $this->objStatusprocesso;
    }

    /**
     * @param StatusProcesso $objStatusprocesso
     * @return OsAndamento
     */
    public function setObjStatusprocesso($objStatusprocesso)
    {
        $this->objStatusprocesso = $objStatusprocesso;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param mixed $datacadastro
     * @return OsAndamento
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
        return $this;
    }



}