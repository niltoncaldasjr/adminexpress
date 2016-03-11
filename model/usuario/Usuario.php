<?php
class Usuario implements JsonSerializable {
	private $id;
	private $nome;
	private $usuario;
	private $senha;
	private $email;
	private $ativo;
    private $telefone;
	private $datacadastro;
	private $dataedicao;
	private $objPerfil;
	
	function __construct($id=null, $nome=null, $usuario=null, $senha=null, $email=null, $ativo=null, $telefone=null, $datacadastro=null, $dataedicao=null, Perfil $objPerfil=null) {
            $this->id = $id;
            $this->nome = $nome;
            $this->usuario = $usuario;
            $this->senha = $senha;
            $this->email = $email;
            $this->ativo = $ativo;
            $this->telefone = $telefone;
            $this->datacadastro = $datacadastro;
            $this->dataedicao = $dataedicao;
            $this->objPerfil = $objPerfil;
        }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     * @return Usuario
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param null $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return null
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param null $usuario
     * @return Usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @return null
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param null $senha
     * @return Usuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return null
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param null $ativo
     * @return Usuario
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return null
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param null $telefone
     * @return Usuario
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return null
     */
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param null $datacadastro
     * @return Usuario
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
        return $this;
    }

    /**
     * @return null
     */
    public function getDataedicao()
    {
        return $this->dataedicao;
    }

    /**
     * @param null $dataedicao
     * @return Usuario
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
        return $this;
    }

    /**
     * @return Perfil
     */
    public function getObjPerfil()
    {
        return $this->objPerfil;
    }

    /**
     * @param Perfil $objPerfil
     * @return Usuario
     */
    public function setObjPerfil($objPerfil)
    {
        $this->objPerfil = $objPerfil;
        return $this;
    }



         
	public function jsonSerialize() {
		return 	[ 
				'id' => $this->id,
				'nome' => $this->nome,
				'usuario' => $this->usuario,
				'email' => $this->email,
				'ativo' => $this->ativo,
                'telefone' => $this->telefone,
				'dataCadastro' => $this->datacadastro,
				'dataEdicao' => $this->dataedicao,
				'perfil' => $this->objPerfil->jsonSerialize()
		];
	}
}