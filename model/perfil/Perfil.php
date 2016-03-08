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

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     * @return Perfil
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
     * @return Perfil
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
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
     * @return Perfil
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
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
     * @return Perfil
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
     * @return Perfil
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
        return $this;
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

