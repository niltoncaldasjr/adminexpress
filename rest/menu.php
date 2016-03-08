<?php
/*
	Verifica métodos requisitado
*/

switch ($_POST['metodo']) {
    case 'listar':
        listar();
        break;

    default:
        break;
}

function listar()
{
    $data = $_POST['data'];

    $con = Conexao::getInstance()->getConexao();

    $folder = [];
    if ($data['idpessoafisica'] == "") {
        $idusuario = 0;
    } else
        $idusuario = $data ['idusuario'];

    if ($idusuario != 0) {
        $queryString = "SELECT p.id_menu id FROM usuario u ";
        $queryString .= "INNER JOIN permissoes p ON u.idperfil = p.id_perfil ";
        $queryString .= "INNER JOIN menu m ON p.id_menu = m.id ";
        $queryString .= "WHERE u.id = '$idusuario' ";
        if ($resultdb = mysqli_query($con, $queryString)) {
            $in = '(';
            while ($user = mysqli_fetch_object($resultdb)) {
                $in .= $user->id . ",";
            }
            $in = substr($in, 0, -1) . ")";
            $sql = "SELECT * FROM menu WHERE sub = 0 ";
            $sql .= "AND id in $in";
            if ($resultdb = mysqli_query($con, $sql)) {
                while ($r = mysqli_fetch_object($resultdb)) {
                    $sqlquery = "SELECT * FROM menu WHERE sub = '";
                    $sqlquery .= $r->id . "' AND id in $in";
                    if ($nodes = mysqli_query($con, $sqlquery)) {
                        $count = $nodes->num_rows;

                        if ($count > 0) {
                            //                    $r ['leaf'] = false; // #18
                            $array = array();
                            while ($item = $nodes->fetch_object()) {
                                //                        $r ['items'] = array();

                                $array[] = array('nome' => $item->nome, 'class' => $item->class, 'href' => $item->href, 'arrow' => "", 'icon' => "", 'sub' => "");
                                //                        var_dump($array);
                            }
                            //                    echo count($array) . "<br>";

                            $r->sub = $array;
                        }
                        $menu [] = array('id' => $r->id, 'nome' => $r->nome, 'class' => $r->class, 'href' => $r->href, 'arrow' => $r->arrow, 'icon' => $r->icon, 'sub' => $r->sub);
                    }
                }
            }

        }
        header('Content-Type: application/json');
        echo json_encode($menu);
    } else {
        echo json_encode(array());
    }
}
