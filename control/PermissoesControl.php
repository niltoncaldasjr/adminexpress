<?php

class PermissoesControl {
	/* Atributos */
	protected $con;
	protected $obj;
	protected $objDAO;
	
	/* Contrutor */
	function __construct (Permissoes $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDAO = new PermissoesDAO($this->con);
		$this->obj = $obj;
	}
	
	 /* Metodos */
	function cadastrarPermissoes () {
		return $this->objDAO->cadastrarPermissoes($this->obj);
	}

	function removerPermissoes() {
		return $this->objDAO->removerPermissoes($this->obj);
	}

	function listarPermissoes($idperfil){
		return $this->objDAO->listarPermissoes($idperfil);
	}
}