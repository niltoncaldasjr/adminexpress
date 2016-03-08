<?php
class Perfil implements JsonSerializable{
	private $id;
	private $nome;
	private $ativo;
	private $datacadastro;
	private $dataedicao;
	
	function __construct($id=null, $nome=null, $ativo=null, $datacadastro=null, $dataedicao=null) {
            $this->id = $id;
            $this->nome = $nome;
            $this->ativo = $ativo;
            $this->datacadastro = $datacadastro;
            $this->dataedicao = $dataedicao;
        }

        function getId() {
            return $this->id;
        }

        function getNome() {
            return $this->nome;
        }

        function getAtivo() {
            return $this->ativo;
        }

        function getDatacadastro() {
            return $this->datacadastro;
        }

        function getDataedicao() {
            return $this->dataedicao;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }

        function setAtivo($ativo) {
            $this->ativo = $ativo;
        }

        function setDatacadastro($datacadastro) {
            $this->datacadastro = $datacadastro;
        }

        function setDataedicao($dataedicao) {
            $this->dataedicao = $dataedicao;
        }

        	
	function __toString(){
		return "Perfil [ id= " . $this->id . ", nome=" . $this->nome . ", ativo=" . $this->ativo . 
		", dataCadastrado=" . $this->datacadastro . " , dataEdicao=" . $this->dataedicao . "]";
	}
	
	public function jsonSerialize() {
		return [
				'id' => $this->id,
				'nome' => $this->nome,
				'ativo' => $this->ativo,
				'dataCadastro' => $this->datacadastro,
				'dataEdicao' => $this->dataedicao
		];
	}
	
}

