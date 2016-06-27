<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 10:52
 */
class OrdemDeServicoDAO
{
    private $con;
    private $sql;
    private $obj;
    private $lista = array();
    //testando
    function __construct($con){
        $this->con = $con;
    }

    function cadastrar(OrdemDeServico $os)
    {
        $query = sprintf("INSERT INTO ordemdeservico (idcliente, idservico, idusuario, observacao, subtotal, desconto, total, status) VALUES (%d,%d,%d,'%s',%f,%f,%f,'%s')",
            mysqli_real_escape_string($this->con, $os->getObjpessoa()->getId()),
            mysqli_real_escape_string($this->con, $os->getObjservico()->getId()),
            mysqli_real_escape_string($this->con, $os->getObjusuario()->getId()),
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

    function atualizar(OrdemDeServico $os)
    {
        $query = sprintf("UPDATE ordemdeservico SET idcliente=%d, idservico=%d, idusuario=%d, observacao='%s', subtotal=%f, desconto=%f, total=%f, status=%d WHERE id=%d",
            mysqli_real_escape_string($this->con, $os->getObjpessoa()->getId()),
            mysqli_real_escape_string($this->con, $os->getObjservico()->getId()),
            mysqli_real_escape_string($this->con, $os->getObjusuario()->getId()),
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

    function listarTodos()
    {
//        $array = array();
        $query = "SELECT * FROM ordemdeservico";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_object($result)){
            $pControl = new PessoaControl();
            $row->idcliente = $pControl->listarJuntosPorId($row->idcliente);

            $s = new Servico($row->idservico);
            $sControl = new ServicoControl($s);
            $row->idservico = $sControl->buscarPorId();

            $itensControl = new OsItensDeServicoControl();
            $row->itensdeservico = $itensControl->listarPorIdOs($row->id);

            $partControl = new OsParticipantesControl();
            $row->participantes = $partControl->listarPorIdOs($row->id);

            $chkControl = new OsChecklistControl();
            $row->checklists = $chkControl->listarPorIdOs($row->id);

            $andControl = new OsAndamentoControl();
            $row->andamentos = $andControl->listarPorIdOs($row->id);
            $this->lista[] = $row;
        }
        return $this->lista;
    }

    function buscarPorId(OrdemDeServico $os)
    {
        $query = sprintf("SELECT * FROM ordemdeservico WHERE id = %d",
            mysqli_real_escape_string($this->con, $os->getId())
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

            $partControl = new OsParticipantesControl();
            $row->participantes = $partControl->listarPorIdOs($row->id);

            $chkControl = new OsChecklistControl();
            $row->checklists = $chkControl->listarPorIdOs($row->id);

            $andControl = new OsAndamentoControl();
            $row->andamentos = $andControl->listarPorIdOs($row->id);

            $this->obj = $row;
        }
        return $this->obj;
    }
}