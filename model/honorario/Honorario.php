<?php


class Honorario implements JsonSerializable
{
    private $id;
    private $objServico;
    private $valor;
    private $datacadastro;
    private $dataedicao;

    /**
     * Honorario constructor.
     * @param $id
     * @param $objServico
     * @param $valor
     * @param $datacadastro
     * @param $dataedicao
     */
    public function __construct($id=null, Servico $objServico=null, $valor=null, $datacadastro=null, $dataedicao=null)
    {
        $this->id = $id;
        $this->objServico = $objServico;
        $this->valor = $valor;
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
     * @return Honorario
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
     * @return Honorario
     */
    public function setObjServico($objServico)
    {
        $this->objServico = $objServico;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     * @return Honorario
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
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
     * @return Honorario
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
     * @return Honorario
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
        return $this;
    }

    function jsonSerialize()
    {

        return [
            "id"            => $this->id,
            "idservico"       => $this->objServico,
            "valor"         => $this->valor,
            "datacadastro"  => $this->datacadastro,
            "dataedicao"    => $this->dataedicao
        ];
    }


}