<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:28
 */
class OsParticipantesDAO
{
    private $con;
    private $obj;
    private $lista = array();

    function __construct($con){
        $this->con = $con;
    }

    function cadastrar(OsParticipantes $part)
    {
        $query = sprintf("INSERT INTO osparticipantes (idos, idcliente, funcao) VALUES (%d,%d,%d)",
            mysqli_real_escape_string($this->con, $part->getObjOrdemdeservico()->getId()),
            mysqli_real_escape_string($this->con, $part->getObjPessoa()->getId()),
            mysqli_real_escape_string($this->con, $part->getFuncao())
        );
        if(!mysqli_query($this->con, $query)) {
            die('[ERRO]: Class('.get_class($part).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }
        $id = mysqli_insert_id($this->con);

        return $id;
    }

    function listarPorIdOs($idos)
    {
        $query = sprintf("SELECT * FROM osparticipantes WHERE idos = %d",
            mysqli_real_escape_string($this->con, $idos)
        );
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_object($result)){
            $participanteControl = new PessoaControl();
            $row->idcliente = $participanteControl->listarJuntosPorId($row->idcliente);
            $this->lista[] = $row;
        }
        return $this->lista;
    }
}