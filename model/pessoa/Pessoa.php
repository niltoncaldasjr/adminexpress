<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 16/03/2016. 
*/

Class Pessoa implements JsonSerializable {
	/* Atributos */
	private $id;
	private $CEP;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $telefone;
	private $fax;
	private $celular;
	private $email1;
	private $email2;
	private $site;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id					= NULL,
		$CEP				= NULL,
		$endereco 			= NULL,
		$numero				= NULL,
		$complemento		= NULL,
		$bairro 			= NULL,
		$telefone			= NULL,
		$fax				= NULL,
		$celular			= NULL,
		$email1				= NULL,
		$email2				= NULL,
		$site				= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->CEP					= $CEP;
		$this->endereco 			= $endereco;
		$this->numero 				= $numero;
		$this->complemento 			= $complemento;
		$this->bairro 				= $bairro;
		$this->telefone 			= $telefone;
		$this->fax 					= $fax;
		$this->celular 				= $celular;
		$this->email1 				= $email1;
		$this->email2 				= $email2;
		$this->site  				= $site;
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
	public function getCEP() {
		return $this->CEP;
	}
	public function setCEP($CEP) {
		$this->CEP = $CEP;
		return $this;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
		return $this;
	}
	public function getNumero() {
		return $this->numero;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
		return $this;
	}
	public function getComplemento() {
		return $this->complemento;
	}
	public function setComplemento($complemento) {
		$this->complemento = $complemento;
		return $this;
	}
	public function getBairro() {
		return $this->bairro;
	}
	public function setBairro($bairro) {
		$this->bairro = $bairro;
		return $this;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
		return $this;
	}
	public function getFax() {
		return $this->fax;
	}
	public function setFax($fax) {
		$this->fax = $fax;
		return $this;
	}
	public function getCelular() {
		return $this->celular;
	}
	public function setCelular($celular) {
		$this->celular = $celular;
		return $this;
	}
	public function getEmail1() {
		return $this->email1;
	}
	public function setEmail1($email1) {
		$this->email1 = $email1;
		return $this;
	}
	public function getEmail2() {
		return $this->email2;
	}
	public function setEmail2($email2) {
		$this->email2 = $email2;
		return $this;
	}
	public function getSite() {
		return $this->site;
	}
	public function setSite($site) {
		$this->site = $site;
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
		return sprintf("Pessoa: ID: %d, Site: %s", $this->id, $this->site);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"CEP"					=> $this->CEP,
			"endereco"				=> $this->endereco,
			"numero" 				=> $this->numero,
			"complemento"			=> $this->complemento,
			"bairro"				=> $this->bairro,
			"telefone"				=> $this->telefone,
			"fax" 					=> $this->fax,
			"celular"				=> $this->celular,
			"email1"				=> $this->email1,
			"email2"				=> $this->email2,
			"site" 					=> $this->site,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
	
}

?>
