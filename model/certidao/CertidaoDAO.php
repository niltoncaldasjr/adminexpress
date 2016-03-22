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

Class CertidaoDAO {
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
    function cadastrar (Certidao $obj) {
        $this->sql = sprintf("INSERT INTO certidao (descricao, prazo, valor)
				VALUES('%s', %d, %f)",
            mysqli_real_escape_string($this->con, $obj->getDescricao()),
            mysqli_real_escape_string($this->con, $obj->getPrazo()),
            mysqli_real_escape_string($this->con, $obj->getValor()));
        if(!mysqli_query($this->con, $this->sql)) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }
        return mysqli_insert_id($this->con);
    }

    /* Atualizar */
    function atualizar (Certidao $obj) {
        $this->sql = sprintf("UPDATE certidao SET descricao = '%s', prazo = %d, valor = %f, dataedicao = '%s' WHERE id = %d",
            mysqli_real_escape_string($this->con, $obj->getDescricao()),
            mysqli_real_escape_string($this->con, $obj->getPrazo()),
            mysqli_real_escape_string($this->con, $obj->getValor()),
            mysqli_real_escape_string($this->con, date('Y-m-d') ),
            mysqli_real_escape_string($this->con, $obj->getId())
        );
        if(!mysqli_query($this->con, $this->sql)) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Atualizar) | Erro('.mysqli_error($this->con).')');
        }
        return true;
    }

    /* Listar */
    function listar () {
        $this->sql = "SELECT * FROM certidao";
        $resultSet = mysqli_query($this->con, $this->sql);
        if(!$resultSet) {
            die('[ERRO]: Class(Certidao) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
        }
        while($row = mysqli_fetch_object($resultSet)) {
//            $this->obj = new Banco($row->id, $row->nome, $row->datacadastro, $row->dataedicao);
//            array_push($this->lista, $this->obj);
            $this->lista[] = $row;
        }
        return $this->lista;
    }

    /* Deletar */
    function deletar (Certidao $obj) {
        $this->sql = sprintf("DELETE FROM certidao WHERE id = %d",
            mysqli_real_escape_string($this->con, $obj->getId()));
        $resultSet = mysqli_query($this->con, $this->sql);
        if(!$resultSet) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
        }
        return true;
    }

    /* Buscar por ID */
    function buscarPorId (Certidao $obj) {
        $this->sql = sprintf("SELECT * FROM certidao WHERE id = %d",
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