<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:20
 */
class OsParticipantes
{
    private $id;
    private $objOrdemdeservico;
    private $objPessoa;
    private $funcao;

    /**
     * OsParticipantes constructor.
     * @param $id
     * @param $objOrdemdeservico
     * @param $objPessoa
     */
    public function __construct($id=NULL, OrdemDeServico $objOrdemdeservico=NULL, Pessoa $objPessoa=NULL)
    {
        $this->id = $id;
        $this->objOrdemdeservico = $objOrdemdeservico;
        $this->objPessoa = $objPessoa;
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
     * @return OsParticipantes
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
     * @return OsParticipantes
     */
    public function setObjOrdemdeservico($objOrdemdeservico)
    {
        $this->objOrdemdeservico = $objOrdemdeservico;
        return $this;
    }

    /**
     * @return Pessoa
     */
    public function getObjPessoa()
    {
        return $this->objPessoa;
    }

    /**
     * @param Pessoa $objPessoa
     * @return OsParticipantes
     */
    public function setObjPessoa($objPessoa)
    {
        $this->objPessoa = $objPessoa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFuncao()
    {
        return $this->funcao;
    }

    /**
     * @param mixed $funcao
     * @return OsParticipantes
     */
    public function setFuncao($funcao)
    {
        $this->funcao = $funcao;
        return $this;
    }

    
}