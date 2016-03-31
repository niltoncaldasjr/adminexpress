<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 31/03/2016. 
*/

Class GrupoPessoa implements JsonSerializable {
	/* Atributos */
	private $id;
	private $objgrupo;
	private $objpessoa;
	private $informacao;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id					= NULL,
		Grupo $objgrupo		= NULL,
		Pessoa $objpessoa	= NULL,
		$informacao			= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->objgrupo 			= $objgrupo;
		$this->objpessoa 			= $objpessoa;
		$this->informacao 			= $informacao;
		$this->datacadastro 		= $datacadastro;
		$this->dataedicao 			= $dataedicao;
	}

	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjgrupo() {
		return $this->objgrupo;
	}
	public function setObjgrupo($objgrupo) {
		$this->objgrupo = $objgrupo;
		return $this;
	}
	public function getObjpessoa() {
		return $this->objpessoa;
	}
	public function setObjpessoa($objpessoa) {
		$this->objpessoa = $objpessoa;
		return $this;
	}
	public function getInformacao() {
		return $this->informacao;
	}
	public function setInformacao($informacao) {
		$this->informacao = $informacao;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}
	
	/* String */
	public function __toString () {
		return sprintf("GrupoPessoa: ID: %d, Grupo: %s", $this->id, $this->objgrupo->getDescricao());
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"objgrupo" 				=> $this->objgrupo->jsonSerialize(),
			"objpessoa" 			=> $this->objpessoa->jsonSerialize(),
			"informacao"			=> $this->informacao,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
		
}

?>
