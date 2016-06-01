<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:15
 */
class OsItensDeServico
{
    private $id;
    private $objOrdemdeservico;
    private $objServico;
    private $quantidade;

    /**
     * OsItensDeServico constructor.
     * @param $id
     * @param $objOrdemdeservico
     * @param $objServico
     * @param $quantidade
     */
    public function __construct($id=NULL, OrdemDeServico $objOrdemdeservico=NULL, Servico $objServico=NULL, $quantidade=NULL)
    {
        $this->id = $id;
        $this->objOrdemdeservico = $objOrdemdeservico;
        $this->objServico = $objServico;
        $this->quantidade = $quantidade;
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
     * @return OsItensDeServico
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return OsItensDeServico
     */
    public function setObjOrdemdeservico($objOrdemdeservico)
    {
        $this->objOrdemdeservico = $objOrdemdeservico;
        return $this;
    }

    /**
     * @return Servico
     */
    public function getObjServico()
    {
        return $this->objServico;
    }

    /**
     * @param Servico $objServico
     * @return OsItensDeServico
     */
    public function setObjServico($objServico)
    {
        $this->objServico = $objServico;
        return $this;
    }

    /**
     * @return null
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param null $quantidade
     * @return OsItensDeServico
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }




}