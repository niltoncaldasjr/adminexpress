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

Class RepresentantePJ implements JsonSerializable {
	/* Atributos */
	private $id;
	private $objpessoapj;
	private $objpessoapf;
	private $funcao;
	private $representante;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id					= NULL,
		Pessoa $objpessoapj	= NULL,
		Pessoa $objpessoapf = NULL,
		$funcao 			= NULL,
		$representante		= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->objpessoapj  		= $objpessoapj;
		$this->objpessoapf			= $objpessoapf;
		$this->funcao 				= $funcao;
		$this->representante 		= $representante;
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
	public function getObjpessoapj() {
		return $this->objpessoapj;
	}
	public function setObjpessoapj($objpessoapj) {
		$this->objpessoapj = $objpessoapj;
		return $this;
	}
	public function getObjpessoapf() {
		return $this->objpessoapf;
	}
	public function setObjpessoapf($objpessoapf) {
		$this->objpessoapf = $objpessoapf;
		return $this;
	}
	public function getFuncao() {
		return $this->funcao;
	}
	public function setFuncao($funcao) {
		$this->funcao = $funcao;
		return $this;
	}
	public function getRepresentante() {
		return $this->representante;
	}
	public function setRepresentante($representante) {
		$this->representante = $representante;
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
		return sprintf("RepresentantePJ: ID: %d, Função: %s", $this->id, $this->funcao);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"objpessoapj" 			=> $this->objpessoapj,
			"objpessoapf" 			=> $this->objpessoapf,
			"funcao" 				=> $this->funcao,
			"representante" 		=> $this->representante,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
}

?>
