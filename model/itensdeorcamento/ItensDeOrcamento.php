<?php

class ItensDeOrcamento
{
    private $id;
    private $objOrcamento;
    private $objServico;
    private $quantidade;

    /**
     * OsItensDeServico constructor.
     * @param $id
     * @param $objOrcamento
     * @param $objServico
     * @param $quantidade
     */
    public function __construct($id=NULL, Orcamento $objOrcamento=NULL, Servico $objServico=NULL, $quantidade=NULL)
    {
        $this->id = $id;
        $this->objOrcamento = $objOrcamento;
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
     * @return Orcamento
     */
    public function getObjOrcamento()
    {
        return $this->objOrcamento;
    }

    /**
     * @param Orcamento $objOrcamento
     * @return OsItensDeServico
     */
    public function setObjOrcamento($objOrcamento)
    {
        $this->objOrcamento = $objOrcamento;
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