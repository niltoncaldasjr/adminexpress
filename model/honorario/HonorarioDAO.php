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

Class HonorarioDAO {
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
    function cadastrar (Honorario $obj) {
        $this->sql = sprintf("INSERT INTO honorario (idservico, valor)
				VALUES(%d, %f)",
            mysqli_real_escape_string($this->con, $obj->getObjServico()->getId()),
            mysqli_real_escape_string($this->con, $obj->getValor())
        );
        if(!mysqli_query($this->con, $this->sql)) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Cadastrar) | Erro('.mysqli_error($this->con).')');
        }
        return mysqli_insert_id($this->con);
    }

    /* Atualizar */
    function atualizar (Honorario $obj) {
        $this->sql = sprintf("UPDATE honorario SET idservico = %d, valor = %f, dataedicao = '%s' WHERE id = %d",
            mysqli_real_escape_string($this->con, $obj->getObjServico()->getId()),
            mysqli_real_escape_string($this->con, $obj->getValor()),
            mysqli_real_escape_string($this->con, date('Y-m-d H:i:s') ),
            mysqli_real_escape_string($this->con, $obj->getId())
        );
        if(!mysqli_query($this->con, $this->sql)) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Atualizar) | Erro('.mysqli_error($this->con).')');
        }
        return true;
    }

    /* Listar */
    function listar () {
        $this->sql = "SELECT * FROM honorario";
        $resultSet = mysqli_query($this->con, $this->sql);
        if(!$resultSet) {
            die('[ERRO]: Class(Honorario) | Metodo(Listar) | Erro('.mysqli_error($this->con).')');
        }
        while($row = mysqli_fetch_object($resultSet)) {

            $objServico = new Servico($row->idservico);
            $controle = new ServicoControl($objServico);
            $objServico = $controle->buscarPorId();

            $row->idservico = $objServico;
            $this->obj = new Honorario($row->id, $objServico, $row->valor, $row->datacadastro, $row->dataedicao);

            $this->lista[] = $this->obj;
        }
        return $this->lista;
    }

    /* Deletar */
    function deletar (Honorario $obj) {
        $this->sql = sprintf("DELETE FROM honorario WHERE id = %d",
            mysqli_real_escape_string($this->con, $obj->getId()));
        $resultSet = mysqli_query($this->con, $this->sql);
        if(!$resultSet) {
            die('[ERRO]: Class('.get_class($obj).') | Metodo(Deletar) | Erro('.mysqli_error($this->con).')');
        }
        return true;
    }

    /* Buscar por ID */
    function buscarPorId (Honorario $obj) {
        $this->sql = sprintf("SELECT * FROM honorario WHERE id = %d",
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