<?php
/*
	Verifica métodos requisitado
*/

switch ($_POST['metodo']) {

    case 'trazer_perfil':
        trazer_perfil();
        break;

    case 'listar':
        listar_perfil();
        break;

    case 'listarpermissoes':
        listar_permissoes();
        break;

    case 'cadastrar':
        cadastrar_perfil();
        break;

    case 'atualizar':
        alterar_perfil();
        break;

    case 'deletar':
        deletar_perfil();
        break;

    default:
        break;
}

function cadastrar_perfil()
{
    $data = $_POST['data'];

    $perfil = new Perfil();
    $perfil->setNome($data['nome']);

    $pControl = new PerfilControl($perfil);
    $id = $pControl->cadastrar();

    if($id){
        echo json_encode(array('result'=> true, 'data'=> $id));
    }else{
        echo json_encode(array('result'=> false));
    }

}

function alterar_perfil()
{
    $data = $_POST['data'];

    $perfil = new Perfil();
    $perfil->setId($data['id'])->setNome($data['nome']);

    $pControl = new PerfilControl($perfil);
    $id = $pControl->atualizar();

    if($id>0){
        echo json_encode(array('result'=> true, 'data'=> $id));
    }else{
        echo json_encode(array('result'=> false));
    }

}

function listar_perfil()
{
    $control = new PerfilControl(new Perfil());
    $listaDePerfil = $control->listarTodos();

    echo json_encode($listaDePerfil);
}

function deletar_perfil()
{
    $data = $_POST['data'];

    $perfil = new Perfil();
    $perfil->setId($data['id']);

    $pControl = new PerfilControl($perfil);

    if($perfil->getId() != 1) {

        if ($msg = $pControl->deletar()) {
            echo json_encode(array('result' => true));
        } else {
            echo json_encode(array('result' => false, 'msg'=> $msg));
        }
    }else{
        echo json_encode(array('result' => false, 'msg'=> 'Necessário manter o perfil Administrador!'));
    }
}

function trazer_perfil()
{
    $data = $_POST['data'];

    $obj = new PessoaFisica($data['idpessoafisica']);
    $objControl = new PessoaFisicaControl( $obj );
    $objpf = $objControl->buscarPorId();

    /** @var $array_nome pegar o primeiro e o ultimo nome da pessoa */
    $array_nome =explode(" ",$objpf->getNome());
    $nome = array('nome' => $array_nome[0] . " " . $array_nome[count($array_nome)- 1]);

    $perfil = new Perfil($data['idperfil']);
    $pControl = new PerfilControl($perfil);
    $perfil = $pControl->buscarPorId();

    $src = 'http://api.nuvio.com.br/img/uploads/pf/' . $data['idusuario'] . '.png';

    if (file_exists($src)) { $src = $src; }
    else{ $src = 'http://api.nuvio.com.br/img/uploads/pf/default.jpg'; }

    $data = array(
        'pessoa' => $nome,
        'perfil' => $perfil ,
        'img' => $src
    );

    echo json_encode( $data );
}

function listar_permissoes(){

    $idperfil = $_POST['data'];
    $con = Conexao::getInstance()->getConexao();
//    $list = array();
//    $query = "SELECT * FROM permissoes WHERE id_perfil = '$idperfil'";
//    $result = mysqli_query($con, $query);
//    while($row = mysqli_fetch_assoc($result)){
//        $idmenu = $row['id_menu'];
//        $sqlmenu = "SELECT id, nome FROM menu WHERE id = '$idmenu'";
//        $resultmenu = mysqli_query($con, $sqlmenu);
//        while($menu = mysqli_fetch_assoc($resultmenu)){
//            $row['id_menu'] = $menu;
//        }
//        $list[] = $row;
//    }
//    echo json_encode($list);

    $queryString = "SELECT e.* FROM perfil u ";
    $queryString .= "INNER JOIN permissoes eu ON u.id = eu.id_perfil ";
    $queryString .= "INNER JOIN menu e ON eu.id_menu = e.id ";
    $queryString .= "WHERE u.id = '$idperfil' ";

// var_dump($queryString);
    $empresas	= array();
    $empresas2 	= array();

    if($resultdb = mysqli_query($con,$queryString)){

        $empresaUsuario = "(";
        while($user = mysqli_fetch_assoc($resultdb)){
            $empresas[] = $user;
            $empresaUsuario .= $user['id'] . ",";

        }

        $empresaUsuario = substr($empresaUsuario, 0, -1) . ")";

        if($empresaUsuario == ")"){$empresaUsuario = "( 0 )";}

        $query = "SELECT * FROM menu WHERE id NOT IN $empresaUsuario";

        // echo $query;

        if($resultdb = mysqli_query($con, $query)){

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
