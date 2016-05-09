<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa.
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 16/03/2016.
*/

Class PessoaJuridicaDAO {
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
	function cadastrar (PessoaJuridica $obj) {
		$this->sql = sprintf("INSERT INTO pessoajuridica (idpessoa, razao, cnpj, nire, inscestadual, inscmunicipal, representante)
				VALUES(%d, '%s', '%s' , '%s', '%s' , '%s', '%s')", 
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()->getId()),
				mysqli_real_escape_string($this->con, $obj->getRazao()),
				mysqli_real_escape_string($this->con, $obj->getCnpj()),
				mysqli_real_escape_string($this->con, $obj->getNire()),
				mysqli_real_escape_string($this->con, $obj->getInscestadual()),
				mysqli_real_escape_string($this->con, $obj->getInscmunicipal()),
				mysqli_real_escape_string($this->con, $obj->getRepresentante()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (PessoaJuridica $obj) {
		var_dump($obj->getId());
		$this->sql = sprintf("UPDATE pessoajuridica SET idpessoa = %d, razao = '%s', cnpj = '%s', nire = '%s', inscestadual = '%s', inscmunicipal = '%s', representante = '%s', dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()->getId()),
				mysqli_real_escape_string($this->con, $obj->getRazao()),
				mysqli_real_escape_string($this->con, $obj->getCnpj()),
				mysqli_real_escape_string($this->con, $obj->getNire()),
				mysqli_real_escape_string($this->con, $obj->getInscestadual()),
				mysqli_real_escape_string($this->con, $obj->getInscmunicipal()),
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
		$this->sql = "SELECT * FROM pessoajuridica";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(PessoaJuridica) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();
			
			$this->obj = new PessoaJuridica($row->id, $objPessoa, razao, cnpj, nire, inscestadual, inscmunicipal, representante, $row->datacadastro, $row->dataedicao);
			
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Listar por RazãoSocial ou CNPJ */
	function listarPorNomeCNPJ (PessoaJuridica $obj) {
		$this->sql = sprintf("SELECT * FROM pessoajuridica WHERE razao LIKE '%s%s%s' || cnpj LIKE '%s%s%s' ",
				mysqli_real_escape_string($this->con, '%'),
				mysqli_real_escape_string($this->con, $obj->getRazao()),
				mysqli_real_escape_string($this->con, '%'),
				mysqli_real_escape_string($this->con, '%'),
				mysqli_real_escape_string($this->con, $obj->getCnpj()),
				mysqli_real_escape_string($this->con, '%'));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(PessoaJuridica) | Metodo(ListarPorNomeCNPJ) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();
	
			$this->obj = new PessoaJuridica($row->id, $objPessoa, $row->razao, $row->cnpj, $row->nire, $row->inscestadual, $row->inscmunicipal, $row->representante, $row->datacadastro, $row->dataedicao);
				
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (PessoaJuridica $obj) {
		$this->sql = sprintf("DELETE FROM pessoajuridica WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (PessoaJuridica $obj) {
		$this->sql = sprintf("SELECT * FROM pessoajuridica WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();
				
			$this->obj = new PessoaJuridica($row->id, $objPessoa, $row->razao, $row->cnpj, $row->nire, $row->inscestadual, $row->inscmunicipal, $row->representante, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
	
	/* Buscar por Pessoa */
	function buscarPorPessoa (PessoaJuridica $obj) {
		$this->sql = sprintf("SELECT * FROM pessoajuridica WHERE idpessoa = %d",
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();
	
			$this->obj = new PessoaJuridica($row->id, $objPessoa, $row->razao, $row->cnpj, $row->nire, $row->inscestadual, $row->inscmunicipal, $row->representante, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
	
	/* Buscar por CNPJ */
	function buscarPorCNPJ (PessoaJuridica $obj) {
		$this->sql = sprintf("SELECT * FROM pessoajuridica WHERE cnpj = '%s'",
				mysqli_real_escape_string($this->con, $obj->getCnpj()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();
	
			$this->obj = new PessoaJuridica($row->id, $objPessoa, $row->razao, $row->cnpj, $row->nire, $row->inscestadual, $row->inscmunicipal, $row->representante, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
}

?>