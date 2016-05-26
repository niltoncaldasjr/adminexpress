<?php

class OrdemDeServico
{
    private $id;
    private $objpessoa;
    private $objservico;
    private $objusuario;
    private $observacao;
    private $ositensservico;
    private $oschecklists;
    private $osparticipantes;
    private $subtotal;
    private $desconto;
    private $total;
    private $status;
    private $andamento;
    private $datacadastro;
    private $dataedicao;

    /**
     * OrdemDeServico constructor.
     * @param $id
     * @param $objpessoa
     * @param $objservico
     * @param $objusuario
     * @param $observacao
     * @param $ositensservico
     * @param $oschecklists
     * @param $osparticipantes
     * @param $subtotal
     * @param $desconto
     * @param $total
     * @param $status
     * @param $andamento
     * @param $datacadastro
     * @param $dataedicao
     */
    public function __construct(
        $id = NULL,
        Pessoa $objpessoa = NULL,
        Servico $objservico = NULL,
        Usuario $objusuario=NULL,
        $observacao=NULL,
        $ositensservico=NULL,
        $oschecklists=NULL,
        $osparticipantes=NULL,
        $subtotal=NULL,
        $desconto=NULL,
        $total=NULL,
        $status=NULL,
        $andamento=NULL,
        $datacadastro=NULL,
        $dataedicao=NULL
    )
    {
        $this->id = $id;
        $this->objpessoa = $objpessoa;
        $this->objservico = $objservico;
        $this->objusuario = $objusuario;
        $this->observacao = $observacao;
        $this->ositensservico = $ositensservico;
        $this->oschecklists = $oschecklists;
        $this->osparticipantes = $osparticipantes;
        $this->subtotal = $subtotal;
        $this->desconto = $desconto;
        $this->total = $total;
        $this->status = $status;
        $this->andamento = $andamento;
        $this->datacadastro = $datacadastro;
        $this->dataedicao = $dataedicao;
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
     * @return OrdemDeServico
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Pessoa
     */
    public function getObjpessoa()
    {
        return $this->objpessoa;
    }

    /**
     * @param Pessoa $objpessoa
     * @return OrdemDeServico
     */
    public function setObjpessoa($objpessoa)
    {
        $this->objpessoa = $objpessoa;
        return $this;
    }

    /**
     * @return Servico
     */
    public function getObjservico()
    {
        return $this->objservico;
    }

    /**
     * @param Servico $objservico
     * @return OrdemDeServico
     */
    public function setObjservico($objservico)
    {
        $this->objservico = $objservico;
        return $this;
    }

    /**
     * @return Usuario
     */
    public function getObjusuario()
    {
        return $this->objusuario;
    }

    /**
     * @param Usuario $objusuario
     * @return OrdemDeServico
     */
    public function setObjusuario($objusuario)
    {
        $this->objusuario = $objusuario;
        return $this;
    }

    /**
     * @return null
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param null $observacao
     * @return OrdemDeServico
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
        return $this;
    }

    /**
     * @return null
     */
    public function getOsitensservico()
    {
        return $this->ositensservico;
    }

    /**
     * @param null $ositensservico
     * @return OrdemDeServico
     */
    public function setOsitensservico($ositensservico)
    {
        $this->ositensservico = $ositensservico;
        return $this;
    }

    /**
     * @return null
     */
    public function getOschecklists()
    {
        return $this->oschecklists;
    }

    /**
     * @param null $oschecklists
     * @return OrdemDeServico
     */
    public function setOschecklists($oschecklists)
    {
        $this->oschecklists = $oschecklists;
        return $this;
    }

    /**
     * @return null
     */
    public function getOsparticipantes()
    {
        return $this->osparticipantes;
    }

    /**
     * @param null $osparticipantes
     * @return OrdemDeServico
     */
    public function setOsparticipantes($osparticipantes)
    {
        $this->osparticipantes = $osparticipantes;
        return $this;
    }

    /**
     * @return null
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param null $subtotal
     * @return OrdemDeServico
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
        return $this;
    }

    /**
     * @return null
     */
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * @param null $desconto
     * @return OrdemDeServico
     */
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
        return $this;
    }

    /**
     * @return null
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param null $total
     * @return OrdemDeServico
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     * @return OrdemDeServico
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return null
     */
    public function getAndamento()
    {
        return $this->andamento;
    }

    /**
     * @param null $andamento
     * @return OrdemDeServico
     */
    public function setAndamento($andamento)
    {
        $this->andamento = $andamento;
        return $this;
    }

    /**
     * @return null
     */
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param null $datacadastro
     * @return OrdemDeServico
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
        return $this;
    }

    /**
     * @return null
     */
    public function getDataedicao()
    {
        return $this->dataedicao;
    }

    /**
     * @param null $dataedicao
     * @return OrdemDeServico
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
        return $this;
    }




}