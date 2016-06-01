<?php

/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 26/05/2016
 * Time: 20:24
 */
class OsChecklist
{
    private $id;
    private $objOrdemdeservico;
    private $objChecklist;
    private $status;

    /**
     * OsChecklist constructor.
     * @param $id
     * @param $objOrdemdeservico
     * @param $objChecklist
     * @param $status
     */
    public function __construct($id=NULL, OrdemDeServico $objOrdemdeservico=NULL, Checklist $objChecklist=NULL, $status=NULL)
    {
        $this->id = $id;
        $this->objOrdemdeservico = $objOrdemdeservico;
        $this->objChecklist = $objChecklist;
        $this->status = $status;
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
     * @return OsChecklist
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return OrdemDeServico
     */
    public function getObjOrdemdeservico()
    {
        return $this->objOrdemdeservico;
    }

    /**
     * @param OrdemDeServico $objOrdemdeservico
     * @return OsChecklist
     */
    public function setObjOrdemdeservico($objOrdemdeservico)
    {
        $this->objOrdemdeservico = $objOrdemdeservico;
        return $this;
    }

    /**
     * @return Checklist
     */
    public function getObjChecklist()
    {
        return $this->objChecklist;
    }

    /**
     * @param Checklist $objChecklist
     * @return OsChecklist
     */
    public function setObjChecklist($objChecklist)
    {
        $this->objChecklist = $objChecklist;
        return $this;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     * @return OsChecklist
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    


}