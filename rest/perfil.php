<?php
/*
	Verifica métodos requisitado
*/

switch ($_POST['metodo']) {

    case 'listar':
        listar_perfil();
        break;

    case 'listarpermissoes':
        listar_permissoes($_POST['data']);
        break;

    case 'addpermissoes':
        addPermissoes();
        break;

    case 'delpermissoes':
        removePermissoes();
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

function addPermissoes(){

    $data = $_POST['data'];

    foreach ($data as $key) :

        $objPermissoes = new Permissoes(null, $key['idmenu'], $key['idperfil']);

        $objPermissoesControl = new PermissoesControl($objPermissoes);

        $objPermissoesControl->cadastrarPermissoes();

    endforeach;

    listar_permissoes($data[0]['idperfil']);

}

function removePermissoes(){

    $data = $_POST['data'];

    foreach ($data as $key) :
        $objPermissoes = new Permissoes(null, $key['idmenu'], $key['idperfil']);

        $objPermissoesControl = new PermissoesControl($objPermissoes);

        $objPermissoesControl->removerPermissoes();

    endforeach;

    listar_permissoes($data[0]['idperfil']);
}


function listar_permissoes($idperfil){

    $controle = new PermissoesControl();
    $controle->listarPermissoes($idperfil);
}
