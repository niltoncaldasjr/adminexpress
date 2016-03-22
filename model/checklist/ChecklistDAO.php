<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimar�es Monteiro.
 	Data de in�cio: 08/03/2016.
 	Data Atual: 08/03/2016.
*/

Class ChecklistDAO {
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
    function cadastrar (Checklist $obj) {
        $this->sql = sprintf("INSERT INTO checklist (idservico, ordem, item)
				VALUES(%d, %d, '%s')",
            mysqli_real_escape_string($this->con, $obj->getObjServico()->getId()),
            mysqli_real_escape_string($this->con, $obj->getOrdem()),
            mysqli_real_escape_string($this->con, $obj->getItem())
        );
        if(!mysqli_query($this->con, $this->sql)) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }
        return mysqli_insert_id($this->con);
    }

    /* Atualizar */
    function atualizar (Checklist $obj) {
        $this->sql = sprintf("UPDATE checklist SET idservico = %d, ordem = %d, item = '%s', dataedicao = '%s' WHERE id = %d",
            mysqli_real_escape_string($this->con, $obj->getObjServico()->getId()),
            mysqli_real_escape_string($this->con, $obj->getOrdem()),
            mysqli_real_escape_string($this->con, $obj->getItem()),
            mysqli_real_escape_string($this->con, $obj->getId())
        );
        if(!mysqli_query($this->con, $this->sql)) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Atualizar) | Erro('.mysqli_error($this->con).')');
        }
        return true;
    }

    /* Listar */
    function listar () {
        $this->sql = "SELECT * FROM checklist";
        $resultSet = mysqli_query($this->con, $this->sql);
        if(!$resultSet) {
            die('[ERRO]: Class(Checklist) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
        }
        while($row = mysqli_fetch_object($resultSet)) {

            $this->lista[] = $row;
        }
        return $this->lista;
    }

    /* Deletar */
    function deletar (Checklist $obj) {
        $this->sql = sprintf("DELETE FROM checklist WHERE id = %d",
            mysqli_real_escape_string($this->con, $obj->getId()));
        $resultSet = mysqli_query($this->con, $this->sql);
        if(!$resultSet) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
        }
        return true;
    }

    /* Buscar por ID */
    function buscarPorId (Checklist $obj) {
        $this->sql = sprintf("SELECT * FROM checklist WHERE id = %d",
            mysqli_real_escape_string($this->con, $obj->getId()));
        $resultSet = mysqli_query($this->con, $this->sql);
        if(!$resultSet) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(buscarPorId) | Erro('.mysqli_error($this->con).')');
        }
        while($row = mysqli_fetch_object($resultSet)) {
            $this->obj = $row;
        }
        return $this->obj;
    }
}