<?php
class Usuario implements JsonSerializable {
	private $id;
	private $nome;
	private $usuario;
	private $senha;
	private $email;
	private $ativo;
	private $datacadastro;
	private $dataedicao;
	private $objPerfil;
	private $objPessoafisica;
	
	function __construct($id=null, $nome=null, $usuario=null, $senha=null, $email=null, $ativo=null, $datacadastro=null, $dataedicao=null, Perfil $objPerfil=null, PessoaFisica $objPessoafisica=null) {
            $this->id = $id;
            $this->nome = $nome;
            $this->usuario = $usuario;
            $this->senha = $senha;
            $this->email = $email;
            $this->ativo = $ativo;
            $this->datacadastro = $datacadastro;
            $this->dataedicao = $dataedicao;
            $this->objPerfil = $objPerfil;
            $this->objPessoafisica = $objPessoafisica;
        }

        function getId() {
            return $this->id;
        }

        function getNome() {
            return $this->nome;
        }

        function getUsuario() {
            return $this->usuario;
        }

        function getSenha() {
            return $this->senha;
        }

        function getEmail() {
            return $this->email;
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

        function getObjPerfil() {
            return $this->objPerfil;
        }

        function getObjPessoafisica() {
            return $this->objPessoafisica;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }

        function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        function setSenha($senha) {
            $this->senha = $senha;
        }

        function setEmail($email) {
            $this->email = $email;
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

        function setObjPerfil($objPerfil) {
            $this->objPerfil = $objPerfil;
        }

        function setObjPessoafisica($objPessoafisica) {
            $this->objPessoafisica = $objPessoafisica;
        }
         
	public function jsonSerialize() {
		return 	[ 
				'id' => $this->id,
				'nome' => $this->nome,
				'usuario' => $this->usuario,
				'senha' => $this->senha,
				'email' => $this->email,
				'ativo' => $this->ativo,
				'dataCadastro' => $this->datacadastro,
				'dataEdicao' => $this->dataedicao,
				'perfil' => $this->objPerfil,
				'PessoaFisica' => $this->objPessoafisica 
		];
	}
}