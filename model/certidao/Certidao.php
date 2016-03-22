<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimar�es Monteiro.
 	Data de in�cio: 08/03/2016.
 	Data Atual: 08/03/2016.
*/

Class Certidao implements JsonSerializable {
    /* Atributos */
    private $id;
    private $descricao;
    private $prazo;
    private $valor;
    private $datacadastro;
    private $dataedicao;

    /**
     * Certidao constructor.
     * @param $id
     * @param $descricao
     * @param $prazo
     * @param $valor
     * @param $datacadastro
     * @param $dataedicao
     */
    public function __construct($id=null, $descricao=null, $prazo=null, $valor=null, $datacadastro=null, $dataedicao=null)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->prazo = $prazo;
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
     * @return Certidao
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     * @return Certidao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrazo()
    {
        return $this->prazo;
    }

    /**
     * @param mixed $prazo
     * @return Certidao
     */
    public function setPrazo($prazo)
    {
        $this->prazo = $prazo;
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
     * @return Certidao
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
     * @return Certidao
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
     * @return Certidao
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
        return $this;
    }



    /* Json */
    public function jsonSerialize () {
        return [
            "id"					=> $this->id,
            "descricao"				=> $this->descricao,
            "prazo"                 => $this->prazo,
            "valor"                 => $this->valor,
            "datacadastro" 			=> $this->datacadastro,
            "dataedicao" 			=> $this->dataedicao
        ];
    }

}