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

Class ContaBanco implements JsonSerializable {
	/* Atributos */
	private $id;
	private $agencia;
	private $digitoAgencia;
	private $numeroConta;
	private $digitoConta;
	private $numeroConta;
	private $digitoConta;
	private $numeroCarteira;
	private $numeroConvenio;
	private $nomeContato;
	private $telefoneContato;
	private $endereco;
	private $objbanco;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id					= NULL,
		$agencia			= NULL,
		$digitoAgencia 		= NULL,
		$numeroConta 		= NULL,
		$digitoConta		= NULL,
		$numeroConta		= NULL,
		$digitoConta		= NULL,
		$numeroCarteira		= NULL,
		$numeroConvenio		= NULL,
		$nomeContato		= NULL,
		$telefoneContato	= NULL,
		$endereco			= NULL,
		Banco $objbanco		= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->agencia 				= $agencia;
		$this->digitoAgencia 		= $digitoAgencia;
		$this->numeroConta 			= $numeroConta;
		$this->digitoConta 			= $digitoConta;
		$this->numeroConta 			= $numeroConta;
		$this->digitoConta 			= $digitoConta;
		$this->numeroCarteira 		= $numeroCarteira;
		$this->numeroConvenio 		= $numeroConvenio;
		$this->nomeContato 			= $nomeContato;
		$this->telefoneContato 		= $telefoneContato;
		$this->endereco 			= $endereco;
		$this->objbanco				= $objbanco;
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
	public function getAgencia() {
		return $this->agencia;
	}
	public function setAgencia($agencia) {
		$this->agencia = $agencia;
		return $this;
	}
	public function getDigitoAgencia() {
		return $this->digitoAgencia;
	}
	public function setDigitoAgencia($digitoAgencia) {
		$this->digitoAgencia = $digitoAgencia;
		return $this;
	}
	public function getNumeroConta() {
		return $this->numeroConta;
	}
	public function setNumeroConta($numeroConta) {
		$this->numeroConta = $numeroConta;
		return $this;
	}
	public function getDigitoConta() {
		return $this->digitoConta;
	}
	public function setDigitoConta($digitoConta) {
		$this->digitoConta = $digitoConta;
		return $this;
	}
	public function getNumeroConta() {
		return $this->numeroConta;
	}
	public function setNumeroConta($numeroConta) {
		$this->numeroConta = $numeroConta;
		return $this;
	}
	public function getDigitoConta() {
		return $this->digitoConta;
	}
	public function setDigitoConta($digitoConta) {
		$this->digitoConta = $digitoConta;
		return $this;
	}
	public function getNumeroCarteira() {
		return $this->numeroCarteira;
	}
	public function setNumeroCarteira($numeroCarteira) {
		$this->numeroCarteira = $numeroCarteira;
		return $this;
	}
	public function getNumeroConvenio() {
		return $this->numeroConvenio;
	}
	public function setNumeroConvenio($numeroConvenio) {
		$this->numeroConvenio = $numeroConvenio;
		return $this;
	}
	public function getNomeContato() {
		return $this->nomeContato;
	}
	public function setNomeContato($nomeContato) {
		$this->nomeContato = $nomeContato;
		return $this;
	}
	public function getTelefoneContato() {
		return $this->telefoneContato;
	}
	public function setTelefoneContato($telefoneContato) {
		$this->telefoneContato = $telefoneContato;
		return $this;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
		return $this;
	}
	public function getObjbanco() {
		return $this->objbanco;
	}
	public function setObjbanco($objbanco) {
		$this->objbanco = $objbanco;
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
		return sprintf("ContaBanco: ID: %d, Agencia: %s", $this->id, $this->agencia);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"agencia" 				=> $this->agencia,
			"digitoAgencia"			=> $this->digitoAgencia,
			"numeroConta"			=> $this->numeroConta,
			"digitoConta"			=> $this->digitoConta,
			"numeroConta"			=> $this->numeroConta,
			"digitoConta"			=> $this->digitoConta,
			"numeroCarteira"		=> $this->numeroCarteira,
			"numeroConvenio" 		=> $this->numeroConvenio,
			"nomeContato"			=> $this->nomeContato,
			"telefoneContato"		=> $this->telefoneContato,
			"endereco"				=> $this->endereco,
			"objbanco"				=> $this->objbanco->jsonSerialize(),
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
	
}

?>
