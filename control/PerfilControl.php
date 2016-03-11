<?php

class PerfilControl{
	protected $con;
	protected $o_perfil;
	protected $o_perfilDAO;

	function __construct(Perfil $o_perfil= null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->o_perfilDAO = new PerfilDAO($this->con);
		$this->o_perfil = $o_perfil;
	}

	function cadastrar(){
		$id = $this->o_perfilDAO->cadastrar($this->o_perfil);
		return $id;  // para desfazer o id de retorno
	}

	function atualizar(){
		return $this->o_perfilDAO->atualizar($this->o_perfil);
	}

	function deletar(){
		return $this->o_perfilDAO->deletar($this->o_perfil);
	}

	function buscarPorId(){
		return $this->o_perfilDAO->buscarPorId($this->o_perfil);
	}

	function listarPorPessoa(){
		return $this->o_perfilDAO->listarPorNome($this->o_perfil);
	}
	
	function listarTodos(){
		return $this->o_perfilDAO->listarTodos();
	}
	 
	function listarPaginado($start, $limit){
		return $this->o_perfilDAO->listarPaginado($start, $limit);
	}
	
	function qtdTotal(){
		return $this->o_perfilDAO->qtdTotal();
	}

}
?>