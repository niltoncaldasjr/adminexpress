<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:28
 */
class ItensDeOrcamentoDAO
{
    private $con;
    private $obj;
    private $lista = array();

    function __construct($con){
        $this->con = $con;
    }

    function cadastrar(ItensDeOrcamento $item)
    {
        $query = sprintf("INSERT INTO itensdeorcamento (idorcamento, idservico, quantidade) VALUES (%d,%d,%d)",
            mysqli_real_escape_string($this->con, $item->getObjOrcamento()->getId()),
            mysqli_real_escape_string($this->con, $item->getObjServico()->getId()),
            mysqli_real_escape_string($this->con, $item->getQuantidade())
        );
        if(!mysqli_query($this->con, $query)) {
            die('[ERRO]: Class('.get_class($item).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }
        $id = mysqli_insert_id($this->con);

        return $id;
    }

    function atualizar(ItensDeOrcamento $item)
    {
//        var_dump($item);
        $query = sprintf("UPDATE itensdeorcamento SET quantidade=%d WHERE id= %d",
            mysqli_real_escape_string($this->con, $item->getQuantidade()),
            mysqli_real_escape_string($this->con, $item->getId())
        );
        if(!mysqli_query($this->con, $query)) {
            die('[ERRO]: Class('.get_class($item).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }

        return true;
    }

    function listarPorIdOrcamento($idorcamento)
    {
        $query = sprintf("SELECT * FROM itensdeorcamento WHERE idorcamento = %d",
            mysqli_real_escape_string($this->con, $idorcamento)
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