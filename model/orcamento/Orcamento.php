<?php

Class Orcamento implements JsonSerializable {
	//atributos
	private $id;
	private $idcliente;
	private $idservico;
	private $idusuario;
	private $observacao;
	private $subtotal;
	private $desconto;
	private $total;
	private $status;
	private $datacadastro;
	private $dataedicao;

	//constutor
	public function __construct
	(
		$id = NULL,
		Pessoa $idcliente = NULL,
		Servico $idservico = NULL,
		Usuario $idusuario = NULL,
		$observacao = NULL,
		$subtotal = NULL,
		$desconto = NULL,
		$total = NULL,
		$status = NULL,
		$datacadastro = NULL,
		$dataedicao = NULL
	)
	{
		$this->id	= $id;
		$this->idcliente	= $idcliente;
		$this->idservico	= $idservico;
		$this->idusuario	= $idusuario;
		$this->observacao	= $observacao;
		$this->subtotal	= $subtotal;
		$this->desconto	= $desconto;
		$this->total	= $total;
		$this->status	= $status;
		$this->datacadastro	= $datacadastro;
		$this->dataedicao	= $dataedicao;
	}

	//Getters e Setters
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getIdcliente() {
		return $this->idcliente;
	}
	public function setIdcliente($idcliente) {
		$this->idcliente = $idcliente;
		return $this;
	}
	public function getIdservico() {
		return $this->idservico;
	}
	public function setIdservico($idservico) {
		$this->idservico = $idservico;
		return $this;
	}
	public function getIdusuario() {
		return $this->idusuario;
	}
	public function setIdusuario($idusuario) {
		$this->idusuario = $idusuario;
		return $this;
	}
	public function getObservacao() {
		return $this->observacao;
	}
	public function setObservacao($observacao) {
		$this->observacao = $observacao;
		return $this;
	}
	public function getSubtotal() {
		return $this->subtotal;
	}
	public function setSubtotal($subtotal) {
		$this->subtotal = $subtotal;
		return $this;
	}
	public function getDesconto() {
		return $this->desconto;
	}
	public function setDesconto($desconto) {
		$this->desconto = $desconto;
		return $this;
	}
	public function getTotal() {
		return $this->total;
	}
	public function setTotal($total) {
		$this->total = $total;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
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

	//Json Serializable
	public function JsonSerialize () {
		return [
			"id"	=> $this->id,
			"idcliente"	=> $this->idcliente,
			"idservico"	=> $this->idservico,
			"idusuario"	=> $this->idusuario,
			"observacao"	=> $this->observacao,
			"subtotal"	=> $this->subtotal,
			"desconto"	=> $this->desconto,
			"total"	=> $this->total,
			"status"	=> $this->status,
			"datacadastro"	=> $this->datacadastro,
			"dataedicao"	=> $this->dataedicao
		];
	}
}