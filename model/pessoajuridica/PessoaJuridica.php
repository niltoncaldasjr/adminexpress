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

Class PessoaJuridica implements JsonSerializable {
	/* Atributos */
	private $id;
	private $objpessoa;
	private $razao;
	private $cnpj;
	private $nire;
	private $inscestadual;
	private $inscmunicipal;
	private $representante;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id					= NULL,
		Pessoa $objpessoa	= NULL,
		$razao				= NULL,
		$cnpj				= NULL,
		$nire				= NULL,
		$inscestadual		= NULL,
		$inscmunicipal		= NULL,
		$representante		= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->objpessoa 			= $objpessoa;
		$this->razao 				= $razao;
		$this->cnpj					= $cnpj;
		$this->nire 				= $nire;
		$this->inscestadual			= $inscestadual;
		$this->inscmunicipal		= $inscmunicipal;
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
	public function getObjpessoa() {
		return $this->objpessoa;
	}
	public function setObjpessoa($objpessoa) {
		$this->objpessoa = $objpessoa;
		return $this;
	}
	public function getRazao() {
		return $this->razao;
	}
	public function setRazao($razao) {
		$this->razao = $razao;
		return $this;
	}
	public function getCnpj() {
		return $this->cnpj;
	}
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
		return $this;
	}
	public function getNire() {
		return $this->nire;
	}
	public function setNire($nire) {
		$this->nire = $nire;
		return $this;
	}
	public function getInscestadual() {
		return $this->inscestadual;
	}
	public function setInscestadual($inscestadual) {
		$this->inscestadual = $inscestadual;
		return $this;
	}
	public function getInscmunicipal() {
		return $this->inscmunicipal;
	}
	public function setInscmunicipal($inscmunicipal) {
		$this->inscmunicipal = $inscmunicipal;
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
		return sprintf("Pessoa: ID: %d, Site: %s", $this->id, $this->site);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"objpessoa"				=> $this->objpessoa->jsonSerialize(),
			"razao"					=> $this->razao,
			"cnpj"					=> $this->cnpj,
			"nire"					=> $this->nire,
			"inscestadual"			=> $this->inscestadual,
			"inscmunicipal" 		=> $this->inscmunicipal,
			"representante"			=> $this->representante,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
	
}

?>
