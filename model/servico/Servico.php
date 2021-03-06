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

Class Servico implements JsonSerializable {
	/* Atributos */
	private $id;
	private $nome;
	private $valor;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id					= NULL,
		$nome				= NULL,
		$valor				= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->nome		 			= $nome;
		$this->valor				= $valor;
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
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getValor()
	{
		return $this->valor;
	}

	/**
	 * @param null $valor
	 * @return Servico
	 */
	public function setValor($valor)
	{
		$this->valor = $valor;
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
		return sprintf("Servico: ID: %d, Nome: %s", $this->id, $this->nome);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"nome"					=> $this->nome,
			"valor"					=> $this->valor,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
}

?>
