<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 08/03/2016. 
*/

Class Grupo implements JsonSerializable {
	/* Atributos */
	private $id;
	private $descricao;
	private $tipo;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id					= NULL,
		$descricao			= NULL,
		$tipo 				= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->descricao 			= $descricao;
		$this->tipo 				= $tipo;
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
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	public function getTipo() {
		return $this->tipo;
	}
	public function setTipo($tipo) {
		$this->tipo = $tipo;
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
		return sprintf("Grupo: ID: %d, Descrição: %s", $this->id, $this->descricao);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"descricao"				=> $this->descricao,
			"tipo" 					=> $this->tipo,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
	
	
}

?>
