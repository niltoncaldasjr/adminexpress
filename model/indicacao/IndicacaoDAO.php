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

Class IndicacaoDAO {
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
	function cadastrar (Indicacao $obj) {
		$this->sql = sprintf("INSERT INTO indicacao (nome, cep, endereco, numero, complemento, bairro, cidade, uf,telefone, email1, email2, celular1, celular2, atividade, observacao, senhaweb)
				VALUES('%s','%s', '%s','%s', '%s','%s', '%s','%s', '%s','%s', '%s','%s', '%s','%s', '%s','%s', '%s','%s')", 
				mysqli_real_escape_string($this->con, $obj->getNome()),
				mysqli_real_escape_string($this->con, $obj->getCep()),
				mysqli_real_escape_string($this->con, $obj->getEndereco()),
				mysqli_real_escape_string($this->con, $obj->getNumero()),
				mysqli_real_escape_string($this->con, $obj->getComplemento()),
				mysqli_real_escape_string($this->con, $obj->getBairro()),
				mysqli_real_escape_string($this->con, $obj->getCidade()),
				mysqli_real_escape_string($this->con, $obj->getUf()),
				mysqli_real_escape_string($this->con, $obj->getTelefone()),
				mysqli_real_escape_string($this->con, $obj->getEmail1()),
				mysqli_real_escape_string($this->con, $obj->getEmail2()),
				mysqli_real_escape_string($this->con, $obj->getCelular1()),
				mysqli_real_escape_string($this->con, $obj->getCelular2()),
				mysqli_real_escape_string($this->con, $obj->getAtividade()),
				mysqli_real_escape_string($this->con, $obj->getObservacao()),
				mysqli_real_escape_string($this->con, $obj->getSenhaweb()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (Indicacao $obj) {
		$this->sql = sprintf("UPDATE indicacao SET nome = '%s', cep = '%s', endereco = '%s', numero = '%s', complemento = '%s', bairro = '%s', cidade = '%s', uf = '%s',telefone = '%s', email1 = '%s', email2 = '%s', celular1 = '%s', celular2 = '%s', atividade = '%s', observacao = '%s', senhaweb = '%s', dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getNome()),
				mysqli_real_escape_string($this->con, $obj->getCep()),
				mysqli_real_escape_string($this->con, $obj->getEndereco()),
				mysqli_real_escape_string($this->con, $obj->getNumero()),
				mysqli_real_escape_string($this->con, $obj->getComplemento()),
				mysqli_real_escape_string($this->con, $obj->getBairro()),
				mysqli_real_escape_string($this->con, $obj->getCidade()),
				mysqli_real_escape_string($this->con, $obj->getUf()),
				mysqli_real_escape_string($this->con, $obj->getTelefone()),
				mysqli_real_escape_string($this->con, $obj->getEmail1()),
				mysqli_real_escape_string($this->con, $obj->getEmail2()),
				mysqli_real_escape_string($this->con, $obj->getCelular1()),
				mysqli_real_escape_string($this->con, $obj->getCelular2()),
				mysqli_real_escape_string($this->con, $obj->getAtividade()),
				mysqli_real_escape_string($this->con, $obj->getObservacao()),
				mysqli_real_escape_string($this->con, $obj->getSenhaweb()),
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
		$this->sql = "SELECT * FROM indicacao";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(Banco) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$this->obj = new Banco($row->id, $row->nome, $row->cep, $row->endereco, $row->numero, $row->complemento, $row->bairro, $row->cidade, $row->uf, $row->telefone, $row->email1, $row->email2, $row->celular1, $row->celular2, $row->atividade, $row->observacao, $row->senhaweb, $row->datacadastro, $row->dataedicao);
			
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (Indicacao $obj) {
		$this->sql = sprintf("DELETE FROM indicacao WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (Indicacao $obj) {
		$this->sql = sprintf("SELECT * FROM indicacao WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$this->obj = new Banco($row->id, $row->nome, $row->cep, $row->endereco, $row->numero, $row->complemento, $row->bairro, $row->cidade, $row->uf, $row->telefone, $row->email1, $row->email2, $row->celular1, $row->celular2, $row->atividade, $row->observacao, $row->senhaweb, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
}

?>