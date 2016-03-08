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

Class Indicacao implements JsonSerializable {
	/* Atributos */
	private $id;
	private $nome;
	private $cep;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $cidade;
	private $uf;
	private $telefone;
	private $email1;
	private $email2;
	private $celular1;
	private $celular2;
	private $atividade;
	private $observacao;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __constructor
	(
		$id					= NULL,
		$nome				= NULL,
		$cep 				= NULL,
		$endereco 			= NULL,
		$numero 			= NULL,
		$complemento 		= NULL,
		$bairro 			= NULL,
		$cidade 			= NULL,
		$uf					= NULL,
		$telefone			= NULL,
		$email1				= NULL,
		$email2				= NULL,
		$celular1			= NULL,
		$celular2			= NULL,
		$atividade			= NULL,
		$observacao			= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id					= $id;
		$this->nome					= $nome;
		$this->cep					= $cep;
		$this->endereco 			= $endereco;
		$this->numero 				= $numero;
		$this->complemento 			= $complemento;
		$this->bairro 				= $bairro;
		$this->cidade 				= $cidade;
		$this->uf					= $uf;
		$this->telefone 			= $telefone;
		$this->email1 				= $email1;
		$this->email2 				= $email2;
		$this->celular1 			= $celular1;
		$this->celular2 			= $celular2;
		$this->atividade 			= $atividade;
		$this->observacao 			= $observacao;
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
	public function getCep() {
		return $this->cep;
	}
	public function setCep($cep) {
		$this->cep = $cep;
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
	public function getCidade() {
		return $this->cidade;
	}
	public function setCidade($cidade) {
		$this->cidade = $cidade;
		return $this;
	}
	public function getUf() {
		return $this->uf;
	}
	public function setUf($uf) {
		$this->uf = $uf;
		return $this;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
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
	public function getCelular1() {
		return $this->celular1;
	}
	public function setCelular1($celular1) {
		$this->celular1 = $celular1;
		return $this;
	}
	public function getCelular2() {
		return $this->celular2;
	}
	public function setCelular2($celular2) {
		$this->celular2 = $celular2;
		return $this;
	}
	public function getAtividade() {
		return $this->atividade;
	}
	public function setAtividade($atividade) {
		$this->atividade = $atividade;
		return $this;
	}
	public function getObservacao() {
		return $this->observacao;
	}
	public function setObservacao($observacao) {
		$this->observacao = $observacao;
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
		return sprintf("Indicacao: ID: %d, Nome: %s", $this->id, $this->nome);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"nome"					=> $this->nome,
			"cep"					=> $this->cep,
			"endereco"				=> $this->endereco,
			"numero"				=> $this->numero,
			"complemento"			=> $this->complemento,
			"bairro"				=> $this->bairro,
			"cidade"				=> $this->cidade,
			"uf" 					=> $this->uf,
			"telefone"				=> $this->telefone,
			"email1"				=> $this->email1,
			"email2"				=> $this->email2,
			"celular1" 				=> $this->celular1,
			"celular2"				=> $this->celular2,
			"atividade"				=> $this->atividade,
			"observacao"			=> $this->observacao,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
}

?>
