<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 07/03/2016.
 	Data Atual: 07/03/2016. 
*/

class StatusProcessoControl {
	/* Atributos */
	protected $con;
	protected $obj;
	protected $objDao;
	
	/* Contrutor */
	function __construct (StatusProcesso $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDao = new StatusProcessoDao($this->con);
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