<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:28
 */
class OsChecklistDAO
{
    private $con;
    private $obj;
    private $lista = array();

    function __construct($con){
        $this->con = $con;
    }

    function cadastrar(OsChecklist $chk)
    {
        $query = sprintf("INSERT INTO oschecklist (idos, idchecklist, status) VALUES (%d,%d,%d)",
            mysqli_real_escape_string($this->con, $chk->getObjOrdemdeservico()->getId()),
            mysqli_real_escape_string($this->con, $chk->getObjChecklist()->getId()),
            mysqli_real_escape_string($this->con, $chk->getStatus())
        );
        if(!mysqli_query($this->con, $query)) {
            die('[ERRO]: Class('.get_class($chk).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }
        $id = mysqli_insert_id($this->con);

        return $id;
    }

    function atualizar(OsChecklist $chk)
    {
        $query = sprintf("UPDATE oschecklist SET status = %d WHERE id = %d",
            mysqli_real_escape_string($this->con, $chk->getStatus()),
            mysqli_real_escape_string($this->con, $chk->getId())
        );
        if(!mysqli_query($this->con, $query)) {
            die('[ERRO]: Class('.get_class($chk).') | Metodo(Atualizar) | Erro('.mysqli_error($this->con).')');
        }
        return true;
    }

    function listarPorIdOs($idos)
    {
        $query = sprintf("SELECT * FROM oschecklist WHERE idos = %d",
            mysqli_real_escape_string($this->con, $idos)
        );
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_object($result)){
            $chkControl = new ChecklistControl(new Checklist($row->idchecklist));
            $row->idchecklist = $chkControl->buscarPorId();
            $row->status == 0 ? $row->status = false : $row->status = true;
            $this->lista[] = $row;
        }
        return $this->lista;
    }
}