<?php

Class OrcamentoDAO {
	//atributos
	private $con;
	private $sql;
	private $obj;
	private $lista = array();

	//construtor
	public function __construct($con) {
		$this->con = $con;
	}

	//cadastrar
	function cadastrar(Orcamento $os)
	{
		$query = sprintf("INSERT INTO orcamento (idcliente, idservico, idusuario, observacao, subtotal, desconto, total, status) VALUES (%d,%d,%d,'%s',%f,%f,%f,'%s')",
			mysqli_real_escape_string($this->con, $os->getIdcliente()->getId()),
			mysqli_real_escape_string($this->con, $os->getIdservico()->getId()),
			mysqli_real_escape_string($this->con, $os->getIdusuario()->getId()),
			mysqli_real_escape_string($this->con, $os->getObservacao()),
			mysqli_real_escape_string($this->con, $os->getSubtotal()),
			mysqli_real_escape_string($this->con, $os->getDesconto()),
			mysqli_real_escape_string($this->con, $os->getTotal()),
			mysqli_real_escape_string($this->con, $os->getStatus())
		);
		if(!mysqli_query($this->con, $query)) {
			die('[ERRO]: Class('.get_class($os).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		$id = mysqli_insert_id($this->con);

		return $id;

	}

	function atualizar(Orcamento $os)
	{
		$query = sprintf("UPDATE orcamento SET idcliente=%d, idservico=%d, idusuario=%d, observacao='%s', subtotal=%f, desconto=%f, total=%f, status=%d WHERE id=%d",
			mysqli_real_escape_string($this->con, $os->getIdcliente()->getId()),
			mysqli_real_escape_string($this->con, $os->getIdservico()->getId()),
			mysqli_real_escape_string($this->con, $os->getIdusuario()->getId()),
			mysqli_real_escape_string($this->con, $os->getObservacao()),
			mysqli_real_escape_string($this->con, $os->getSubtotal()),
			mysqli_real_escape_string($this->con, $os->getDesconto()),
			mysqli_real_escape_string($this->con, $os->getTotal()),
			mysqli_real_escape_string($this->con, $os->getStatus()),
			mysqli_real_escape_string($this->con, $os->getId())
		);
		if(!mysqli_query($this->con, $query)) {
			die('[ERRO]: Class('.get_class($os).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
		}
		return $os;

	}

	//buscarPorId
	function buscarPorId(Orcamento $orc)
	{
		$query = sprintf("SELECT * FROM orcamento WHERE id = %d",
			mysqli_real_escape_string($this->con, $orc->getId())
		);
		$result = mysqli_query($this->con, $query);
		while ($row = mysqli_fetch_object($result)){
			$pControl = new PessoaControl();
			$row->idcliente = $pControl->listarJuntosPorId($row->idcliente);

			$s = new Servico($row->idservico);
			$sControl = new ServicoControl($s);
			$row->idservico = $sControl->buscarPorId();

			$itensControl = new OsItensDeServicoControl();
			$row->itensdeservico = $itensControl->listarPorIdOs($row->id);

			$this->obj = $row;
		}
		return $this->obj;
	}

	//listar
	function listar()
	{
//        $array = array();
		$query = "SELECT * FROM orcamento";
		$result = mysqli_query($this->con, $query);
		while ($row = mysqli_fetch_object($result)){
			$pControl = new PessoaControl();
			$row->idcliente = $pControl->listarJuntosPorId($row->idcliente);

			$s = new Servico($row->idservico);
			$sControl = new ServicoControl($s);
			$row->idservico = $sControl->buscarPorId();

			$itensControl = new ItensDeOrcamentoControl();
			$row->itensdeorcamento = $itensControl->listarPorIdOrcamento($row->id);

			$this->lista[] = $row;
		}
		return $this->lista;
	}

	//deletar
	function deletar (Orcamento $obj) {
		$this->sql = sprintf("DELETE FROM orcamento WHERE id = %d",
			mysqli_real_escape_string($this->con, $obj->getId()));
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet) {
			die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
		}
		return true;
	}

}