<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa.
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 01/04/2016.
*/

Class ProfissaoDAO {
	/* Atributos */
	private $con;	//conexao
	private $sql; 	//sql
	private $obj; 	//obj da class
	private $lista = array(); //lista da class
	
	/* Construtor */
	public function __construct($con) {
		$this->con = $con;
	}
	
	/* Cadastrar */
	function cadastrar (Profissao $obj) {
		$this->sql = sprintf("INSERT INTO profissao (descricao)
				VALUES('%s')", 
				mysqli_real_escape_string($this->con, $obj->getDescricao()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (Profissao $obj) {
		var_dump($obj->getId());
		$this->sql = sprintf("UPDATE profissao SET descricao = '%s', dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getDescricao()),
				mysqli_real_escape_string($this->con, date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string($this->con, $obj->getId())
				);
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Atualizar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Listar */
	function listar () {
		$this->sql = "SELECT * FROM profissao";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(Profissao) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$this->obj = new Profissao($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (Profissao $obj) {
		$this->sql = sprintf("DELETE FROM profissao WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (Profissao $obj) {
		$this->sql = sprintf("SELECT * FROM profissao WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$this->obj = new Profissao($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
}

?>