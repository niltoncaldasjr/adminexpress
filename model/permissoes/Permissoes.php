<?php

class Permissoes
{
    private $id;
    private $idmenu;
    private $idperfil;

    /**
     * Permissoes constructor.
     * @param $idmenu
     * @param $idperfil
     */
    public function __construct($id=null, $idmenu=null, $idperfil=null)
    {
        $this->id = $id;
        $this->idmenu = $idmenu;
        $this->idperfil = $idperfil;
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
     * @return Permissoes
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdmenu()
    {
        return $this->idmenu;
    }

    /**
     * @param mixed $idmenu
     * @return Permissoes
     */
    public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdperfil()
    {
        return $this->idperfil;
    }

    /**
     * @param mixed $idperfil
     * @return Permissoes
     */
    public function setIdperfil($idperfil)
    {
        $this->idperfil = $idperfil;
        return $this;
    }



}