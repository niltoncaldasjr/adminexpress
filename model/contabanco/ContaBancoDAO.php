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

Class ContaBancoDAO {
	/* Atributos */
	private $con;	//conexao
	private $sql; 	//sql
	private $obj; 	//obj da class
	private $lista; //lista da class
	
	/* Construtor */
	public function __construct($con) {
		$this->con = $con;
	}
	
	/* Cadastrar */
	function cadastrar (ContaBanco $obj) {
		$this->sql = sprintf("INSERT INTO contabanco (agencia, digitoAgencia, numeroConta, digitoConta, numeroCarteira, numeroConvenio, nomeContato, telefoneContato, endereco, idbanco)
				VALUES('%s','%s', '%s','%s', '%s','%s', '%s','%s', '%s', %d)", 
				mysqli_real_escape_string($this->con, $obj->getAgencia()),
				mysqli_real_escape_string($this->con, $obj->getDigitoAgencia()),
				mysqli_real_escape_string($this->con, $obj->getNumeroConta()),
				mysqli_real_escape_string($this->con, $obj->getDigitoConta()),
				mysqli_real_escape_string($this->con, $obj->getNumeroCarteira()),
				mysqli_real_escape_string($this->con, $obj->getnumeroConvenio()),
				mysqli_real_escape_string($this->con, $obj->getNomeContato()),
				mysqli_real_escape_string($this->con, $obj->getTelefoneContato()),
				mysqli_real_escape_string($this->con, $obj->getEndereco()),
				mysqli_real_escape_string($this->con, $obj->getObjbanco()->getId()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (ContaBanco $obj) {
		$this->sql = sprintf("UPDATE contabanco SET agencia = '%s', digitoAgencia = '%s', numeroConta = '%s', digitoConta = '%s', numeroCarteira = '%s', numeroConvenio = '%s', nomeContato = '%s', telefoneContato = '%s', endereco = '%s', idbanco = %d, dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getAgencia()),
				mysqli_real_escape_string($this->con, $obj->getDigitoAgencia()),
				mysqli_real_escape_string($this->con, $obj->getNumeroConta()),
				mysqli_real_escape_string($this->con, $obj->getDigitoConta()),
				mysqli_real_escape_string($this->con, $obj->getNumeroCarteira()),
				mysqli_real_escape_string($this->con, $obj->getnumeroConvenio()),
				mysqli_real_escape_string($this->con, $obj->getNomeContato()),
				mysqli_real_escape_string($this->con, $obj->getTelefoneContato()),
				mysqli_real_escape_string($this->con, $obj->getEndereco()),
				mysqli_real_escape_string($this->con, $obj->getObjbanco()->getId()),
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
		$this->sql = "SELECT * FROM contabanco";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(ContaBanco) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objBancoControl = new BancoControl(new Banco($row->idbanco));
			$objBanco = $objBancoControl->buscarPorId();
			
			$this->obj = new Banco($row->id, $row->agencia, $row->digitoAgencia, $row->numeroConta, $row->digitoConta, $row->numeroCarteira, $row->numeroConvenio, $row->nomeContato, $row->telefoneContato, $row->endereco, $objBanco, $row->datacadastro, $row->dataedicao);
			
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (ContaBanco $obj) {
		$this->sql = sprintf("DELETE FROM contabanco WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (ContaBanco $obj) {
		$this->sql = sprintf("SELECT * FROM contabanco WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$this->obj = new Banco($row->id, $row->agencia, $row->digitoAgencia, $row->numeroConta, $row->digitoConta, $row->numeroCarteira, $row->numeroConvenio, $row->nomeContato, $row->telefoneContato, $row->endereco, $objBanco, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
}

?>