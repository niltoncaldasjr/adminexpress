<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa.
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 31/03/2016.
*/

Class GrupoPessoaDAO {
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
	function cadastrar (GrupoPessoa $obj) {
		$this->sql = sprintf("INSERT INTO grupopessoa (idgrupo, idpessoa, informacao)
				VALUES(%d, %d, '%s')", 
				mysqli_real_escape_string($this->con, $obj->getObjgrupo()->getId()),
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()->getId()),
				mysqli_real_escape_string($this->con, $obj->getInformacao()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (GrupoPessoa $obj) {
		var_dump($obj->getId());
		$this->sql = sprintf("UPDATE grupopessoa SET idgrupo = %d, idpessoa = %d, informacao = '%s', dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getObjgrupo()->getId()),
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()->getId()),
				mysqli_real_escape_string($this->con, $obj->getInformacao()),
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
		$this->sql = "SELECT * FROM grupopessoa";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(GrupoPessoa) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$grupoControl = new GrupoControl(new Grupo($row->idgrupo));
			$objGrupo = $grupoControl->buscarPorId();
			
			$pessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $pessoaControl->buscarPorId();
			
			$this->obj = new GrupoPessoa($row->id, $objGrupo, $objPessoa, $row->informacao, $row->datacadastro, $row->dataedicao);
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (GrupoPessoa $obj) {
		$this->sql = sprintf("DELETE FROM grupopessoa WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (GrupoPessoa $obj) {
		$this->sql = sprintf("SELECT * FROM grupopessoa WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$grupoControl = new GrupoControl(new Grupo($row->idgrupo));
			$objGrupo = $grupoControl->buscarPorId();
			
			$pessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $pessoaControl->buscarPorId();
			
			$this->obj = new GrupoPessoa($row->id, $objGrupo, $objPessoa, $row->informacao, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
}

?>