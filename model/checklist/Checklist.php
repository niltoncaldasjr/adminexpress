<?php


class Checklist implements JsonSerializable
{
    private $id;
    private $objServico;
    private $ordem;
    private $item;
    private $datacadastro;
    private $dataedicao;

    /**
     * Checklist constructor.
     * @param $id
     * @param $objServico
     * @param $ordem
     * @param $item
     * @param $datacadastro
     * @param $dataedicao
     */
    public function __construct($id=null, Servico $objServico=null, $ordem=null, $item=null, $datacadastro=null, $dataedicao=null)
    {
        $this->id = $id;
        $this->objServico = $objServico;
        $this->ordem = $ordem;
        $this->item = $item;
        $this->datacadastro = $datacadastro;
        $this->dataedicao = $dataedicao;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Checklist
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObjServico()
    {
        return $this->objServico;
    }

    /**
     * @param mixed $objServico
     * @return Checklist
     */
    public function setObjServico($objServico)
    {
        $this->objServico = $objServico;
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
     * @return Checklist
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataedicao()
    {
        return $this->dataedicao;
    }

    /**
     * @param mixed $dataedicao
     * @return Checklist
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
        return $this;
    }

    /**
     * @return null
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * @param null $ordem
     * @return Checklist
     */
    public function setOrdem($ordem)
    {
        $this->ordem = $ordem;
        return $this;
    }

    /**
     * @return null
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param null $item
     * @return Checklist
     */
    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }


    function jsonSerialize()
    {

        return [
            "id"            => $this->id,
            "idservico"       => $this->objServico,
            "ordem"         => $this->ordem,
            "item"          => $this->item,
            "datacadastro"  => $this->datacadastro,
            "dataedicao"    => $this->dataedicao
        ];
    }


}