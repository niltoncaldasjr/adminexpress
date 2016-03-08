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

class IndidcacaoControl {
	/* Atributos */
	protected $con;
	protected $obj;
	protected $objDao;
	
	/* Contrutor */
	function __construct (Indicacao $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDao = new IndicacaoDao($this->con);
		$this->obj = $obj;
	}
	
	 /* Metodos */
	function cadastrar () {
		return $this->objDao->cadastrar($this->obj);
	}
	function atualizar () {
		return $this->objDao->atualizar($this->obj);
	}
	function listar () {
		return $this->objDao->listar();
	}
	function deletar () {
		return $this->objDao->deletar($this->obj);
	}
function buscarPorId () {
		return $this->objDao->buscarPorId($this->obj);
	}
}

?>