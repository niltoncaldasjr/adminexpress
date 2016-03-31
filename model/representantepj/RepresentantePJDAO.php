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

Class RepresentantePJDAO {
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
	function cadastrar (RepresentantePJ $obj) {
		$this->sql = sprintf("INSERT INTO representantepj (idpessoapj, idpessoapf, funcao, representante)
				VALUES(%d, %d, '%s', '%s')", 
				mysqli_real_escape_string($this->con, $obj->getObjpessoapj()->getId()),
				mysqli_real_escape_string($this->con, $obj->getObjpessoapf()->getId()),
				mysqli_real_escape_string($this->con, $obj->getFuncao()),
				mysqli_real_escape_string($this->con, $obj->getRepresentante()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (RepresentantePJ $obj) {
		var_dump($obj->getId());
		$this->sql = sprintf("UPDATE representantepj SET idpessoapj = %d, idpessoapf = %d, funcao = '%s', representante = '%s', dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getObjpessoapj()->getId()),
				mysqli_real_escape_string($this->con, $obj->getObjpessoapf()->getId()),
				mysqli_real_escape_string($this->con, $obj->getFuncao()),
				mysqli_real_escape_string($this->con, $obj->getRepresentante()),
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
		$this->sql = "SELECT * FROM representantepj";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(RepresentantePJ) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$pessoaPJControl = new PessoaControl(new Pessoa($row->idpessoapj));
			$objPJ = $pessoaPJControl->buscarPorId();
			
			$pessoaPFControl = new PessoaControl(new Pessoa($row->idpessoapf));
			$objPF = $pessoaPFControl->buscarPorId();
			
			$this->obj = new RepresentantePJ($row->id, $objPJ, $objPF, $row->funcao, $row->representante, $row->datacadastro, $row->dataedicao);
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (RepresentantePJ $obj) {
		$this->sql = sprintf("DELETE FROM representantepj WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (RepresentantePJ $obj) {
		$this->sql = sprintf("SELECT * FROM representantepj WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$pessoaPJControl = new PessoaControl(new Pessoa($row->idpessoapj));
			$objPJ = $pessoaPJControl->buscarPorId();
			
			$pessoaPFControl = new PessoaControl(new Pessoa($row->idpessoapf));
			$objPF = $pessoaPFControl->buscarPorId();
			
			$this->obj = new RepresentantePJ($row->id, $objPJ, $objPF, $row->funcao, $row->representante, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
}

?>