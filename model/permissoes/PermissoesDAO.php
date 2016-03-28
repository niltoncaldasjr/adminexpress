<?php

class PermissoesDAO
{
    private $con;
    private $lista = array();

    function __construct($con){
        $this->con = $con;
    }

    function cadastrarPermissoes(Permissoes $perm){

        $query = sprintf("INSERT INTO permissoes (id_menu, id_perfil) VALUES (%d, %d)",
            mysqli_real_escape_string($this->con, $perm->getIdmenu()),
            mysqli_real_escape_string($this->con, $perm->getIdperfil()));

        if (!mysqli_query($this->con, $query)) {
            die('Error: ' . mysqli_error($this->con));
        }
        return mysqli_insert_id($this->con);

    }

    function removerPermissoes(Permissoes $perm){

        $idperfil = $perm->getIdperfil();
        $idmenu = $perm->getIdmenu();

        $query = sprintf("DELETE FROM permissoes WHERE id_menu = $idmenu AND id_perfil = $idperfil",
            mysqli_real_escape_string($this->con, $perm->getIdmenu()),
            mysqli_real_escape_string($this->con, $perm->getIdperfil()));
        if (!mysqli_query($this->con, $query)) {
            die('Error: ' . mysqli_error($this->con));
        }
        return $perm;
    }

    function listarPermissoes($idperfil){

        $queryString = "SELECT e.* FROM perfil u ";
        $queryString .= "INNER JOIN permissoes eu ON u.id = eu.id_perfil ";
        $queryString .= "INNER JOIN menu e ON eu.id_menu = e.id ";
        $queryString .= "WHERE u.id = '$idperfil' ";

        $empresas	= array();
        $empresas2 	= array();

        if($resultdb = mysqli_query($this->con,$queryString)){

            $empresaUsuario = "(";
            while($user = mysqli_fetch_assoc($resultdb)){
                $empresas[] = $user;
                $empresaUsuario .= $user['id'] . ",";

            }

            $empresaUsuario = substr($empresaUsuario, 0, -1) . ")";

            if($empresaUsuario == ")"){$empresaUsuario = "( 0 )";}

            $query = "SELECT * FROM menu WHERE id NOT IN $empresaUsuario";

            // echo $query;

            if($resultdb = mysqli_query($this->con, $query)){

                while($empresa = mysqli_fetch_assoc($resultdb)){
                    $empresas2[] = $empresa;
                }

            }

            $success = 'true';
            $msg = 'Sucesso';

            /*-- Encodamos para o json --*/
        }else{
            $success = 'false';
            $msg = 'Nenhum dado encontrado';
        }
        echo json_encode(array(
            "success" => $success,
            "permissoes" => $empresas,
            "menus" => $empresas2,
            "msg" => $msg
        ));
    }
}