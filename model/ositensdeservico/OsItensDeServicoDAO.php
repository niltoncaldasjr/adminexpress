<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:28
 */
class OsItensDeServicoDAO
{
    private $con;
    private $obj;
    private $lista = array();

    function __construct($con){
        $this->con = $con;
    }

    function cadastrar(OsItensDeServico $item)
    {
        $query = sprintf("INSERT INTO ositensdeservico (idos, idservico, quantidade) VALUES (%d,%d,%d)",
            mysqli_real_escape_string($this->con, $item->getObjOrdemdeservico()->getId()),
            mysqli_real_escape_string($this->con, $item->getObjServico()->getId()),
            mysqli_real_escape_string($this->con, $item->getQuantidade())
        );
        if(!mysqli_query($this->con, $query)) {
            die('[ERRO]: Class('.get_class($item).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }
        $id = mysqli_insert_id($this->con);

        return $id;
    }

    function atualizar(OsItensDeServico $item)
    {
//        var_dump($item);
        $query = sprintf("UPDATE ositensdeservico SET quantidade=%d WHERE id= %d",
            mysqli_real_escape_string($this->con, $item->getQuantidade()),
            mysqli_real_escape_string($this->con, $item->getId())
        );
        if(!mysqli_query($this->con, $query)) {
            die('[ERRO]: Class('.get_class($item).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }

        return true;
    }

    function listarPorIdOs($idos)
    {
        $query = sprintf("SELECT * FROM ositensdeservico WHERE idos = %d",
            mysqli_real_escape_string($this->con, $idos)
        );
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_object($result)){
            $sControl = new ServicoControl(new Servico($row->idservico));
            $row->idservico = $sControl->buscarPorId();
            
            $this->lista[] = $row;
        }
        return $this->lista;
    }
}