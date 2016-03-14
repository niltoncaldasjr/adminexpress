<?php

class PerfilDAO {
	private $con;
	private $sql;
	private $o_perfil;
	private $lista = array();
	//testando
	function __construct($con){
		$this->con = $con;
	}
	
	function cadastrar(Perfil $o_perfil){	
		
		$this->sql = sprintf("INSERT INTO perfil (nome) VALUES ('%s')",
				mysqli_real_escape_string($this->con, $o_perfil->getNome()));
		
		if (!mysqli_query($this->con, $this->sql)) {
			die('Error: ' . mysqli_error($this->con));
		}
		return mysqli_insert_id($this->con);
	}
	
	function atualizar(Perfil $o_perfil){
		$this->sql = sprintf("UPDATE perfil SET nome= '%s', dataedicao='%s' WHERE id=%d",
		mysqli_real_escape_string($this->con, $o_perfil->getNome()),
		mysqli_real_escape_string($this->con, date('Y-m-d H:i:s')),
		mysqli_real_escape_string($this->con, $o_perfil->getId()));
		
		if (!mysqli_query($this->con, $this->sql)) {
			die('Error: ' . mysqli_error($this->con));
		}
		return $o_perfil->getId();
	}
	
	function deletar(Perfil $o_perfil){
		$id = $o_perfil->getId();
		$this->sql = "DELETE FROM perfil WHERE id='" . $id ."'" ;
		if (!mysqli_query($this->con, $this->sql)) {
			die('Error: ' . mysqli_error($this->con));
//			$msg = 'Error: ' . mysqli_error($this->con);
		}
		return $id;
	}
	
	function buscarPorId(Perfil $o_perfil){
		$id = $o_perfil->getId();
	
		$this->sql= "SELECT * FROM perfil WHERE id= '" . $id . "'";
		$result = mysqli_query($this->con, $this->sql);
		if (!$result) {
			die('Error: ' . mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($result)){
			$this->o_perfil = new Perfil($row->id, $row->nome, $row->ativo, $row->datacadastro, $row->dataedicao);
					
		}		
	
		return $this->o_perfil;
	}
	
	function listarTodos(){
		$this->sql= "SELECT * from perfil" ;
		$result = mysqli_query($this->con, $this->sql);
		if (!$result) {
			die('Error: ' . mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($result)){
			
			$this->o_perfil = new Perfil($row->id, $row->nome, $row->ativo, $row->datacadastro, $row->dataedicao);
			
			$this->lista[] = $this->o_perfil;
		}

		return $this->lista;
	}
	
	function listarPaginado($start, $limit){
		$this->sql= "SELECT * from perfil limit " . $start . ", " . $limit;
		$result = mysqli_query($this->con, $this->sql);
		if (!$result) {
			die('Error: ' . mysqli_error($this->con));
		}
		while($row = mysqli_fetch_assoc($result)){
				
			$lista [] = $row;
			}
			
			return $lista;
	}
	
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM perfil";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		$total = 0;
		while ( $row = mysqli_fetch_object ( $result ) ) {
			$total = $row->quantidade;
		}
	
		return $total;
	}
	
	function listarPorNome(Perfil $o_perfil){
		$this->sql= "SELECT * FROM perfil WHERE nome like '" . $o_perfil->getNome() . "%'" ;
		$result = mysqli_query($this->con, $this->sql);
		if (!$result) {
			die('Error: ' . mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($result)){
			
			$this->o_perfil = new Perfil($row->id, $row->nome, $row->ativo, $row->datacadastro, $row->dataedicao);
			
			$this->lista[] = $this->o_perfil;
		}

		return $this->lista;
	}
}
