<?php

class OrdemDeServico
{
    private $id;
    private $objpessoa;
    private $objusuario;
    private $objservico;
    private $itensservico;
    private $status;
    private $observacao;
    private $datacadastro;
    private $dataedicao;

    /**
     * OrdemDeServico constructor.
     * @param $id
     * @param $objpessoa
     * @param $objusuario
     * @param $objservico
     * @param $itensservico
     * @param $status
     * @param $observacao
     */
    public function __construct($id=null, Pessoa $objpessoa=null, Usuario $objusuario=null, Servico $objservico=null, $itensservico=null, $status=null, $observacao=null)
    {
        $this->id = $id;
        $this->objpessoa    = $objpessoa;
        $this->objusuario   = $objusuario;
        $this->objservico   = $objservico;
        $this->itensservico = $itensservico;
        $this->status       = $status;
        $this->observacao   = $observacao;
    }



}