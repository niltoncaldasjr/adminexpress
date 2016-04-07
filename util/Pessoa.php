<?php

/**
 * Class Pessoa **************** CLASSE PAI
 */

class Pessoa
{
    protected $id;
    protected $tipo;
    protected $datacadastro;
    protected $dataedicao;

    /**
     * Pessoa constructor.
     * @param $tipo
     * @param $id
     */
    public function __construct($id=null,$tipo=null)
    {
        $this->tipo = $tipo;
        $this->id = $id;
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
     * @return Pessoa
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param null $tipo
     * @return Pessoa
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param mixed $datacadastro
     * @return Pessoa
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataedicao()
    {
        return $this->dataedicao;
    }

    /**
     * @param mixed $dataedicao
     * @return Pessoa
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
        return $this;
    }


}

/**
 * Class PessoaDAO *************************** DAO DA CLASSE PAI
 */

class PessoaDAO{

    private $sql;
    private $con;

    /**
     * PessoaDAO constructor.
     */
    public function __construct($con)
    {
        $this->sql = null;
        $this->con = $con;
    }

    /**
     * @return mixed
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * @param mixed $con
     * @return PessoaDAO
     */
    public function setCon($con)
    {
        $this->con = $con;
        return $this;
    }

    /**
     * @param $tipo
     * @return int|string
     */

    public function cadastrarPessoa($tipo){
        $this->sql = sprintf("INSERT INTO pessoa (tipo) VALUES ('%s')",
            mysqli_real_escape_string($this->con, $tipo));

        mysqli_query($this->con, $this->sql);

        return mysqli_insert_id($this->con);
    }

    /**
                    ****************** METODO QUE AJUDA A LISTAR TODAS PESSOAS
     *              ****************** ESPECIFICANDO DADOS TANTO DE PF QUANTO PJ
     * * @param $p
     * @return array|null
     */
    public function especificarTipo(Pessoa $p){
        $classe = null;

        if($p->getTipo() == 'PJ') {
            $classe = 'pessoajuridica';
        }else if($p->getTipo() == 'PF') {
            $classe = 'pessoafisica';
        }
        $id = $p->getId();
        $this->sql = sprintf("SELECT * FROM $classe WHERE id = $id");
        $result = mysqli_query($this->con, $this->sql);
        while($row = mysqli_fetch_assoc($result)){
            $pessoa = $row;
        }
        return $pessoa;
    }

    public function buscarPessoaPorId(Pessoa $p){
        $pf = array();
        $pj = array();
        $id = $p->getId();
        $this->sql = sprintf("SELECT * FROM pessoa WHERE id = $id");
        $result = mysqli_query($this->con, $this->sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['tipo'] == 'PJ'){
                $p->setTipo('PJ');
                $row['pj'] = self::especificarTipo($p);
                $pj = $row;
            }else if($row['tipo'] == 'PF'){
                $p->setTipo('PF');
                $row['pf'] = self::especificarTipo($p);
                $pf = $row;
            }
        }
        return array('pf' => $pf, 'pj' => $pj);
    }

    /**
     * @return array ************** METODO LISTAR TODOS
     */

    public function listarPessoas(){
        $lista= array();
        $pf = array();
        $pj = array();

        $this->sql = sprintf("SELECT * FROM pessoa");
        $result = mysqli_query($this->con, $this->sql);
        while($row = mysqli_fetch_assoc($result)){

            if($row['tipo'] == 'PJ'){
                $row['pj'] = self::especificarTipo(new Pessoa($row['id'], $row['tipo']));
                $pj[] = $row;
            }else if($row['tipo'] == 'PF'){
                $row['pf'] = self::especificarTipo(new Pessoa($row['id'], $row['tipo']));
                $pf[] = $row;
            }
        }
        return array('pf' => $pf, 'pj' => $pj);
    }
}

/**
 * Class PessoaControl ************** CONTROL DA CLASSE PESSOA
 */

class PessoaControl
{
    protected $con;
    protected $obj;
    protected $dao;

    function __construct(Pessoa $obj=null){
        $this->con = Conexao::getInstance()->getConexao();
        $this->dao = new PessoaDAO($this->con);
        $this->obj = $obj;
    }

    function listarPessoas(){
        return $this->dao->listarPessoas($this->obj);
    }

    function buscarPessoaPorId(){
        return $this->dao->buscarPessoaPorId($this->obj);
    }
}