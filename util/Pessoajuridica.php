<?php

/**
 * Class Pessoajuridica ***************************
 */

class Pessoajuridica extends Pessoa
{
    private $razaosocial;
    private $cnpj;
    private $insmunicipal;

    /**
     * Pessoajuridica constructor.
     * @param $razaosocial
     * @param $cnpj
     * @param $insmunicipal
     */
    public function __construct($razaosocial = null, $cnpj = null, $insmunicipal = null)
    {
        $this->razaosocial = $razaosocial;
        $this->cnpj = $cnpj;
        $this->insmunicipal = $insmunicipal;
    }

    /**
     * @return mixed
     */
    public function getRazaosocial()
    {
        return $this->razaosocial;
    }

    /**
     * @param mixed $razaosocial
     * @return Pessoajuridica
     */
    public function setRazaosocial($razaosocial)
    {
        $this->razaosocial = $razaosocial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     * @return Pessoajuridica
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInsmunicipal()
    {
        return $this->insmunicipal;
    }

    /**
     * @param mixed $insmunicipal
     * @return Pessoajuridica
     */
    public function setInsmunicipal($insmunicipal)
    {
        $this->insmunicipal = $insmunicipal;
        return $this;
    }
}

/**
 * Class PessoajuridicaDAO ***********************************
 */

class PessoajuridicaDAO extends PessoaDAO
{

//    private $con;

    /**
     * PessoajuridicaDAO constructor.
     */
    public function __construct($con)
    {
        parent::setCon($con);
    }


    public function cadastrarPessoaJuridica(Pessoajuridica $pj)
    {

        $idP = self::cadastrarPessoa($pj->getTipo());

        if ($idP > 0) {

            $pj->setId($idP);

            $query = sprintf("INSERT INTO pessoajuridica (id, razaosocial, cnpj, insmunicipal) VALUES (%d, '%s', '%s', '%s')",
                mysqli_real_escape_string(parent::getCon(), $pj->getId()),
                mysqli_real_escape_string(parent::getCon(), $pj->getRazaosocial()),
                mysqli_real_escape_string(parent::getCon(), $pj->getCnpj()),
                mysqli_real_escape_string(parent::getCon(), $pj->getInsmunicipal()));

            mysqli_query(parent::getCon(), $query);

            return $pj;//mysqli_insert_id(parent::getCon());

        } else {
            return 'Nao foi possivel fazer a insercao';
        }
    }

}

/**
 * Class PessoajuridicaControl *************************************
 */

class PessoajuridicaControl
{
    protected $con;
    protected $obj;
    protected $dao;

    function __construct(Pessoajuridica $obj=null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->dao = new PessoajuridicaDAO($this->con);
        $this->obj = $obj;
    }

    function cadastrarPJ(){
        return $this->dao->cadastrarPessoaJuridica($this->obj);
    }
}