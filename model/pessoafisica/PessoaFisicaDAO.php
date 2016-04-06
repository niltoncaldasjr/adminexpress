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

Class PessoaFisicaDAO {
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
	function cadastrar (PessoaFisica $obj) {
		$this->sql = sprintf("INSERT INTO pessoafisica (idpessoa, nome, cpf, nacionalidade, naturalidade, datanascimento, estadocivil, nomeconjuge, idprofissao, tipodoc, numerodoc, orgaodoc, dataemissaodoc, pai, mae, sexo)
				VALUES(%d, '%s', '%s', '%s', '%s', '%s' , '%s', '%s' , %d, '%s' , '%s', '%s', '%s', '%s', '%s', '%s')", 
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()->getId()),
				mysqli_real_escape_string($this->con, $obj->getNome()),
				mysqli_real_escape_string($this->con, $obj->getCpf()),
				mysqli_real_escape_string($this->con, $obj->getNacionalidade()),
				mysqli_real_escape_string($this->con, $obj->getNaturaldade()),
				mysqli_real_escape_string($this->con, $obj->getDatanascimento()),
				mysqli_real_escape_string($this->con, $obj->getEstadocivil()),
				mysqli_real_escape_string($this->con, $obj->getNomeconjuge()),
				mysqli_real_escape_string($this->con, $obj->getObjprofissao()->getId()),
				mysqli_real_escape_string($this->con, $obj->getTipodoc()),
				mysqli_real_escape_string($this->con, $obj->getNumerodoc()),
				mysqli_real_escape_string($this->con, $obj->getOrgaodoc()),
				mysqli_real_escape_string($this->con, $obj->getDataemissaodoc()),
				mysqli_real_escape_string($this->con, $obj->getPai()),
				mysqli_real_escape_string($this->con, $obj->getMae()),
				mysqli_real_escape_string($this->con, $obj->getSexo()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (PessoaFisica $obj) {
		var_dump($obj->getId());
		$this->sql = sprintf("UPDATE pessoafisica SET idpessoa = %d, nome = '%s', cpf = '%s', nacionalidade = '%s', naturalidade = '%s', datanascimento = '%s', estadocivil = '%s', nomeconjuge = '%s', idprofissao = %d, tipodoc = '%s', numerodoc = '%s', orgaodoc = '%s', dataemissaodoc = '%s', pai = '%s', mae = '%s', sexo = '%s', dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()),
				mysqli_real_escape_string($this->con, $obj->getCpf()),
				mysqli_real_escape_string($this->con, $obj->getNacionalidade()),
				mysqli_real_escape_string($this->con, $obj->getNaturaldade()),
				mysqli_real_escape_string($this->con, $obj->getDatanascimento()),
				mysqli_real_escape_string($this->con, $obj->getEstadocivil()),
				mysqli_real_escape_string($this->con, $obj->getNomeconjuge()),
				mysqli_real_escape_string($this->con, $obj->getObjprofissao()),
				mysqli_real_escape_string($this->con, $obj->getTipodoc()),
				mysqli_real_escape_string($this->con, $obj->getNumerodoc()),
				mysqli_real_escape_string($this->con, $obj->getOrgaodoc()),
				mysqli_real_escape_string($this->con, $obj->getDataemissaodoc()),
				mysqli_real_escape_string($this->con, $obj->getPai()),
				mysqli_real_escape_string($this->con, $obj->getMae()),
				mysqli_real_escape_string($this->con, $obj->getSexo()),
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
		$this->sql = "SELECT * FROM pessoafisica";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(PessoaFisica) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpesoa));
			$objPessoa = $objPessoaControl->buscarPorId();
			
			$this->obj = new PessoaFisica($row->id, $objPessoa, $row->nome, $row->cpf, $row->nacionalidade, $row->naturalidade, $row->datanascimento, $row->estadocivil, $row->nomeconjuge, $row->idprofissao, $row->tipodoc, $row->numerodoc, $row->orgaodoc, $row->dataemissaodoc, $row->pai, $row->mae, $row->sexo, $row->datacadastro, $row->dataedicao);
			
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (PessoaFisica $obj) {
		$this->sql = sprintf("DELETE FROM pessoafisica WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (PessoaFisica $obj) {
		$this->sql = sprintf("SELECT * FROM pessoafisica WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();
			
			$profissaoControl = new ProfissaoControl(new Profissao($row->idprofissao));
			$objProfissao = $profissaoControl->buscarPorId();
			
			$this->obj = new PessoaFisica($row->id, $objPessoa, $row->nome, $row->cpf, $row->nacionalidade, $row->naturalidade, $row->datanascimento, $row->estadocivil, $row->nomeconjuge, $objProfissao, $row->tipodoc, $row->numerodoc, $row->orgaodoc, $row->dataemissaodoc, $row->pai, $row->mae, $row->sexo, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
	
	/* Buscar por Pessoa */
	function buscarPorPessoa (PessoaFisica $obj) {
		$this->sql = sprintf("SELECT * FROM pessoafisica WHERE idpessoa = %d",
				mysqli_real_escape_string($this->con, $obj->getObjpessoa()->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();
				
			$profissaoControl = new ProfissaoControl(new Profissao($row->idprofissao));
			$objProfissao = $profissaoControl->buscarPorId();
				
			$this->obj = new PessoaFisica($row->id, $objPessoa, $row->nome, $row->cpf, $row->nacionalidade, $row->naturalidade, $row->datanascimento, $row->estadocivil, $row->nomeconjuge, $objProfissao, $row->tipodoc, $row->numerodoc, $row->orgaodoc, $row->dataemissaodoc, $row->pai, $row->mae, $row->sexo, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
}

?>