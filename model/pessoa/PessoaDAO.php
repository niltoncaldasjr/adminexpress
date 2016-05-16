<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa.
 	Desenvolverdor: Adelson Guimar�es Monteiro.
 	Data de in�cio: 08/03/2016.
 	Data Atual: 16/03/2016.
*/

Class PessoaDAO {
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
	function cadastrar (Pessoa $obj) {
		$this->sql = sprintf("INSERT INTO pessoa (tipo, CEP, endereco, numero, complemento, bairro, telefone, fax, celular, email1, email2, site)
				VALUES('%s', '%s', '%s', '%s', '%s', '%s' , '%s', '%s' , '%s', '%s' , '%s', '%s')", 
				mysqli_real_escape_string($this->con, $obj->getTipo()),
				mysqli_real_escape_string($this->con, $obj->getCEP()),
				mysqli_real_escape_string($this->con, $obj->getEndereco()),
				mysqli_real_escape_string($this->con, $obj->getNumero()),
				mysqli_real_escape_string($this->con, $obj->getComplemento()),
				mysqli_real_escape_string($this->con, $obj->getBairro()),
				mysqli_real_escape_string($this->con, $obj->getTelefone()),
				mysqli_real_escape_string($this->con, $obj->getFax()),
				mysqli_real_escape_string($this->con, $obj->getCelular()),
				mysqli_real_escape_string($this->con, $obj->getEmail1()),
				mysqli_real_escape_string($this->con, $obj->getEmail2()),
				mysqli_real_escape_string($this->con, $obj->getSite()));
		if(!mysqli_query($this->con, $this->sql)) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return mysqli_insert_id($this->con);
	}
	
	/* Atualizar */
	function atualizar (Pessoa $obj) {
		var_dump($obj->getId());
		$this->sql = sprintf("UPDATE pessoa SET tipo = '%s', CEP = '%s', endereco = '%s', numero = '%s', complemento = '%s', bairro = '%s', telefone = '%s', fax = '%s', celular = '%s', email1 = '%s', email2 = '%s', site = '%s', dataedicao = '%s' WHERE id = %d", 
				mysqli_real_escape_string($this->con, $obj->getTipo()),
				mysqli_real_escape_string($this->con, $obj->getCEP()),
				mysqli_real_escape_string($this->con, $obj->getEndereco()),
				mysqli_real_escape_string($this->con, $obj->getNumero()),
				mysqli_real_escape_string($this->con, $obj->getComplemento()),
				mysqli_real_escape_string($this->con, $obj->getBairro()),
				mysqli_real_escape_string($this->con, $obj->getTelefone()),
				mysqli_real_escape_string($this->con, $obj->getFax()),
				mysqli_real_escape_string($this->con, $obj->getCelular()),
				mysqli_real_escape_string($this->con, $obj->getEmail1()),
				mysqli_real_escape_string($this->con, $obj->getEmail2()),
				mysqli_real_escape_string($this->con, $obj->getSite()),
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
		$this->sql = "SELECT * FROM pessoa";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(Pessoa) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$this->obj = new Pessoa($row->id, $row->tipo, $row->CEP, $row->endereco, $row->numero, $row->complemento, $row->bairro, $row->telefone, $row->fax, $row->celular, $row->email1, $row->email2, $row->site, $row->datacadastro, $row->dataedicao);
			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
	
	/* Deletar */
	function deletar (Pessoa $obj) {
		$this->sql = sprintf("DELETE FROM pessoa WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}
	
	/* Buscar por ID */
	function buscarPorId (Pessoa $obj) {
		$this->sql = sprintf("SELECT * FROM pessoa WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$this->obj = new Pessoa($row->id, $row->tipo, $row->CEP, $row->endereco, $row->numero, $row->complemento, $row->bairro, $row->telefone, $row->fax, $row->celular, $row->email1, $row->email2, $row->site, $row->datacadastro, $row->dataedicao);
		}
		return $this->obj;
	}
	
	/* Buscar por ID Pessoa Fisica */
	function buscarPFPorId (Pessoa $obj) {
		$this->sql = sprintf("SELECT * FROM pessoa WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPF = new PessoaFisica(); $objPF->setObjpessoa(new Pessoa($row->id));
			$pfControl = new PessoaFisicaControl($objPF);
			$this->obj = $pfControl->buscarPorPessoa();
		}
		return $this->obj;
	}
	
	/* Buscar por ID Pessoa Juridica */
	function buscarPJPorId (Pessoa $obj) {
		$this->sql = sprintf("SELECT * FROM pessoa WHERE id = %d",
				mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPJ = new PessoaJuridica(); $objPJ->setObjpessoa(new Pessoa($row->id));
			$pjControl = new PessoaJuridicaControl($objPJ);
			$this->obj = $pjControl->buscarPorPessoa();
		}
		return $this->obj;
	}

	function listarJuntos ($nome) {
		$this->sql = sprintf("SELECT * FROM clientesview WHERE nome LIKE '%s%s%s'",
			mysqli_real_escape_string($this->con, '%'),
			mysqli_real_escape_string($this->con, $nome),
			mysqli_real_escape_string($this->con, '%'));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(Pessoa) | Metodo(listarJuntos) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
//			var_dump($row);
			$this->lista[] = $row;
		}
		return $this->lista;
	}
	function listarPorNome (PessoaFisica $obj) {
		$this->sql = sprintf("SELECT * FROM pessoafisica WHERE nome LIKE '%s%s%s'",
			mysqli_real_escape_string($this->con, '%'),
			mysqli_real_escape_string($this->con, $obj->getNome()),
			mysqli_real_escape_string($this->con, '%'));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class(PessoaFisica) | Metodo(ListarPorNomeCPF) | Erro('.mysqli_error($this->con).')');
		}
		while($row = mysqli_fetch_object($resultSet)) {
			$objPessoaControl = new PessoaControl(new Pessoa($row->idpessoa));
			$objPessoa = $objPessoaControl->buscarPorId();

			$profissaoControl = new ProfissaoControl(new Profissao($row->idprofissao));
			$objProfissao = $profissaoControl->buscarPorId();

			$this->obj = new PessoaFisica($row->id, $objPessoa, $row->nome, $row->cpf, $row->nacionalidade, $row->naturalidade, $row->datanascimento, $row->estadocivil, $row->nomeconjuge, $objProfissao, $row->tipodoc, $row->numerodoc, $row->orgaodoc, $row->dataemissaodoc, $row->pai, $row->mae, $row->sexo, $row->datacadastro, $row->dataedicao);

			array_push($this->lista, $this->obj);
		}
		return $this->lista;
	}
}

?>