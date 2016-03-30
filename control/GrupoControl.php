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

class GrupoControl {
	/* Atributos */
	protected $con;
	protected $obj;
	protected $objDAO;
	
	/* Contrutor */
	function __construct (Grupo $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDAO = new GrupoDAO($this->con);
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
	function deletar () {
		return $this->objDAO->deletar($this->obj);
	}
	function buscarPorId () {
		return $this->objDAO->buscarPorId($this->obj);
	}
	function buscarPorDescricao () {
		return $this->objDAO->buscarPorDescricao($this->obj);
	}
}

?>