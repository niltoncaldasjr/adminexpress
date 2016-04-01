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

Class PessoaFisica implements JsonSerializable {
	/* Atributos */
	private $id;
	private $objpessoa;
	private $nome;
	private $cpf;
	private $nacionalidade;
	private $naturaldade;
	private $datanascimento;
	private $estadocivil;
	private $nomeconjuge;
	private $objprofissao;
	private $tipodoc;
	private $numerodoc;
	private $orgaodoc;
	private $dataemissaodoc;
	private $pai;
	private $mae;
	private $sexo;
	private $datacadastro;
	private $dataedicao;

	/* Construtor */
	public function __construct
	(
		$id							= NULL,
		Pessoa $objpessoa			= NULL,
		$nome						= NULL,
		$cpf						= NULL,
		$nacionalidade				= NULL,
		$naturaldade 				= NULL,
		$datanascimento				= NULL,
		$estadocivil				= NULL,
		$nomeconjuge				= NULL,
		Profissao $objprofissao		= NULL,
		$tipodoc					= NULL,
		$numerodoc					= NULL,
		$orgaodoc					= NULL,
		$dataemissaodoc				= NULL,
		$pai						= NULL,
		$mae						= NULL,
		$sexo						= NULL,
		$datacadastro				= NULL,
		$dataedicao 				= NULL
	)
	{
		$this->id					= $id;
		$this->objpessoa			= $objpessoa;
		$this->nome 				= $nome;
		$this->cpf 					= $cpf;
		$this->nacionalidade		= $nacionalidade;
		$this->naturaldade 			= $naturaldade;
		$this->datanascimento		= $datanascimento;
		$this->estadocivil			= $estadocivil;
		$this->nomeconjuge 			= $nomeconjuge;
		$this->objprofissao 		= $objprofissao;
		$this->tipodoc 				= $tipodoc;
		$this->numerodoc 			= $numerodoc;
		$this->orgaodoc 			= $orgaodoc;
		$this->dataemissaodoc 	 	= $dataemissaodoc;
		$this->pai 					= $pai;
		$this->mae 					= $mae;
		$this->sexo 				= $sexo;
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
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
		return $this;
	}
	public function getCpf() {
		return $this->cpf;
	}
	public function setCpf($cpf) {
		$this->cpf = $cpf;
		return $this;
	}
	public function getNacionalidade() {
		return $this->nacionalidade;
	}
	public function setNacionalidade($nacionalidade) {
		$this->nacionalidade = $nacionalidade;
		return $this;
	}
	public function getNaturaldade() {
		return $this->naturaldade;
	}
	public function setNaturaldade($naturaldade) {
		$this->naturaldade = $naturaldade;
		return $this;
	}
	public function getDatanascimento() {
		return $this->datanascimento;
	}
	public function setDatanascimento($datanascimento) {
		$this->datanascimento = $datanascimento;
		return $this;
	}
	public function getEstadocivil() {
		return $this->estadocivil;
	}
	public function setEstadocivil($estadocivil) {
		$this->estadocivil = $estadocivil;
		return $this;
	}
	public function getNomeconjuge() {
		return $this->nomeconjuge;
	}
	public function setNomeconjuge($nomeconjuge) {
		$this->nomeconjuge = $nomeconjuge;
		return $this;
	}
	public function getObjprofissao() {
		return $this->objprofissao;
	}
	public function setObjprofissao($objprofissao) {
		$this->objprofissao = $objprofissao;
		return $this;
	}
	public function getTipodoc() {
		return $this->tipodoc;
	}
	public function setTipodoc($tipodoc) {
		$this->tipodoc = $tipodoc;
		return $this;
	}
	public function getNumerodoc() {
		return $this->numerodoc;
	}
	public function setNumerodoc($numerodoc) {
		$this->numerodoc = $numerodoc;
		return $this;
	}
	public function getOrgaodoc() {
		return $this->orgaodoc;
	}
	public function setOrgaodoc($orgaodoc) {
		$this->orgaodoc = $orgaodoc;
		return $this;
	}
	public function getDataemissaodoc() {
		return $this->dataemissaodoc;
	}
	public function setDataemissaodoc($dataemissaodoc) {
		$this->dataemissaodoc = $dataemissaodoc;
		return $this;
	}
	public function getPai() {
		return $this->pai;
	}
	public function setPai($pai) {
		$this->pai = $pai;
		return $this;
	}
	public function getMae() {
		return $this->mae;
	}
	public function setMae($mae) {
		$this->mae = $mae;
		return $this;
	}
	public function getSexo() {
		return $this->sexo;
	}
	public function setSexo($sexo) {
		$this->sexo = $sexo;
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
		return sprintf("PessoaFisica: ID: %d, Nome: %s", $this->id, $this->nome);
	}
	
	/* Json */
	public function jsonSerialize () {
		return [
			"id"					=> $this->id,
			"objpessoa"				=> $this->objpessoa->jsonSerialize(),
			"nome"					=> $this->nome,
			"cpf"					=> $this->cpf,
			"nacionalidade"			=> $this->nacionalidade,
			"naturalidade"			=> $this->naturaldade,
			"datanascimento"		=> $this->datanascimento,
			"estadocivil"			=> $this->estadocivil,
			"nomeconjuge"			=> $this->nomeconjuge,
			"objprofissao"			=> $this->objprofissao->jsonSerialize(),
			"tipodoc"				=> $this->tipodoc,
			"numerodoc"				=> $this->numerodoc,
			"orgaodoc" 				=> $this->orgaodoc,
			"dataemissaodoc"		=> $this->dataemissaodoc,
			"pai"					=> $this->pai,
			"mae"					=> $this->mae,
			"sexo"					=> $this->sexo,
			"datacadastro" 			=> $this->datacadastro,
			"dataedicao" 			=> $this->dataedicao
		];
	}
	
}

?>
