<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimar�es Monteiro.
 	Data de in�cio: 08/03/2016.
 	Data Atual: 16/03/2016. 
*/

class PessoaJuridicaControl {
	/* Atributos */
	protected $con;
	protected $obj;
	protected $objDAO;
	
	/* Contrutor */
	function __construct (PessoaJuridica $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDAO = new PessoaJuridicaDAO($this->con);
		$this->obj = $obj;
	}
	
	 /* Metodos */
	function cadastrar () {
		return $this->objDAO->cadastrar($this->obj);
	}
	function atualizar () {
		return $this->objDAO->atualizar($this->obj);
	}
	function listar () {
		return $this->objDAO->listar();
	}
	function listarPorNomeCNPJ () {
		return $this->objDAO->listarPorNomeCNPJ($this->obj);
	}
	function deletar () {
		return $this->objDAO->deletar($this->obj);
	}
	function buscarPorId () {
		return $this->objDAO->buscarPorId($this->obj);
	}
	function buscarPorPessoa () {
		return $this->objDAO->buscarPorPessoa($this->obj);
	}
	function buscarPorCNPJ () {
		return $this->objDAO->buscarPorCNPJ($this->obj);
	}
}

?>