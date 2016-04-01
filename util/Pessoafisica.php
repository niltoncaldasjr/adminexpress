<?php

/**
 * Class Pessoafisica ***************************************
 */

class Pessoafisica extends Pessoa
{
    private $nome;
    private $rg;
    private $sexo;
    private $email;

    /**
     * Pessoafisica constructor.
     * @param $nome
     * @param $rg
     * @param $sexo
     * @param $email
     */
    public function __construct($nome=null, $rg=null, $sexo=null, $email=null)
    {
        $this->nome = $nome;
        $this->rg = $rg;
        $this->sexo = $sexo;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return Pessoafisica
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     * @return Pessoafisica
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     * @return Pessoafisica
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Pessoafisica
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

}

/**
 * Class PessoafisicaDAO ***************************************
 */

class PessoafisicaDAO extends PessoaDAO{

    /**
     * PessoafisicaDAO constructor.
     */
    public function __construct($con)
    {
        parent::setCon($con);
    }

    public function cadastrarPessoaFisica(Pessoafisica $pf){

        $idP = self::cadastrarPessoa($pf->getTipo());

        if($idP > 0){

            $pf->setId($idP);

            $query = sprintf("INSERT INTO pessoafisica (id, nome, rg, sexo, email) VALUES (%d, '%s', '%s', '%s', '%s')",
                mysqli_real_escape_string(parent::getCon(), $pf->getId()),
                mysqli_real_escape_string(parent::getCon(), $pf->getNome()),
                mysqli_real_escape_string(parent::getCon(), $pf->getRg()),
                mysqli_real_escape_string(parent::getCon(), $pf->getSexo()),
                mysqli_real_escape_string(parent::getCon(), $pf->getEmail()));

            mysqli_query(parent::getCon(),$query);

            return $pf;//mysqli_insert_id(parent::getCon());
        }else{
            return 'Nao foi possivel fazer a insercao';

        }
    }

}

/**
 * Class PessoafisicaControl ****************************************
 */

class PessoafisicaControl
{
    protected $con;
    protected $obj;
    protected $dao;

    function __construct(Pessoafisica $obj=null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->dao = new PessoafisicaDAO($this->con);
        $this->obj = $obj;
    }

    function cadastrarPF(){
        return $this->dao->cadastrarPessoaFisica($this->obj);
    }
}