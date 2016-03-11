<?php
if(!$_POST){ // Se POST estiver vazio.
    $_POST = json_decode ( file_get_contents ( "php://input" ), true ); //convertendo em array
}

// require_once '../php/LogSistema/Cadastrar.php';

switch ($_POST['metodo']) {

    case 'cadastrarUsuarioCupom':
        cadastrarUsuarioCupom();
        break;

    case 'redefinir_senha':
        redefinirSenha();
        break;

    case 'ativar_usuario':
        ativarUsuario();
        break;

    case 'listar':
        listar_usuario();
        break;

    case 'cadastrar':
//        var_dump($_POST);
        cadastrar_usuario();
        break;

    case 'atualizar':
//        var_dump($_POST);
        alterar_usuario();
        break;

    case 'deletar':
        var_dump($_POST);
//        deletar_usuario();
        break;

    default;
        break;

}

function cadastrar_usuario()
{
    $data = $_POST['data'];

    $usuario = new Usuario();
    $usuario->setNome($data['nome'])
        ->setUsuario($data['usuario'])
        ->setEmail($data['email'])
        ->setSenha($data['senha'])
        ->setAtivo($data['ativo'])
        ->setObjPerfil(new Perfil($data['perfil']['id']))
        ->setTelefone($data['telefone']);


    $pControl = new UsuarioControl($usuario);
    $id = $pControl->cadastrar();
    if($id){
        echo json_encode(array('result'=> true, 'data'=> $id));
    }else{
        echo json_encode(array('result'=> false));
    }

}

function alterar_usuario()
{
    $data = $_POST['data'];

    $usuario = new Usuario();
    $usuario->setId($data['id'])
        ->setNome($data['nome'])
        ->setUsuario($data['usuario'])
        ->setEmail($data['email'])
        ->setAtivo($data['ativo'])
        ->setObjPerfil(new Perfil($data['perfil']['id']))
        ->setTelefone($data['telefone']);


    $pControl = new UsuarioControl($usuario);
    $id = $pControl->atualizar();

    if($id>0){
        echo json_encode(array('result'=> true, 'data'=> $id));
    }else{
        echo json_encode(array('result'=> false));
    }

}

function listar_usuario()
{
    $control = new UsuarioControl(new Usuario());
    $listaDeUsuario = $control->listarTodos();

    echo json_encode($listaDeUsuario);
}

function deletar_usuario()
{
    $data = $_POST['data'];

    $usuario = new Usuario();
    $usuario->setId($data['id']);

    $pControl = new UsuarioControl($usuario);


    if($pControl->deletar()){
        echo json_encode(array('result'=> true));
    }else{
        echo json_encode(array('result'=> false));
    }
}





function cadastrarUsuarioCupom() {

    $data = $_POST['data'];
    
    $obj = new Usuario();
    $obj->setUsuario($data['usuario']);
    $control = new UsuarioControl($obj);
    $obj = $control->buscarPorUsuario();

    if($obj) {
        $result = array("success" => false, "msg" => "Este e-mail já é registrado!");
    }else{

        /*
            Cadastramos primeiro a pessoa física
        */
        $objPFControl = new PessoaFisicaControl( new PessoaFisica() );
        $idPF = $objPFControl->cadastrar();

        if($idPF) {

            $object = new Usuario();
            $object->setNome($data['usuario']);
            $object->setUsuario($data['usuario']);
            $object->setEmail($data['usuario']);
            $object->setSenha( $data['senha'] );
            $object->setObjPerfil(new Perfil(3));//perfil usuario

            $objControl = new UsuarioControl($object);
            $idUsuario = $objControl->cadastrar();

            if($idUsuario) {

                $object->setId($idUsuario);

                $jsonDepois = json_encode( $object );
                $jsonAntes = $jsonDepois;

                /*-- LogSistema      class -               ID -  NIVEL  -   AÃ‡ÃƒO  - ANTES - DEPOIS --*/
                // CadastraLogSistema( get_class($object), $idUsuario, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);

                $objControl = new UsuarioControl(new Usuario($idUsuario));
                $obj = $objControl->buscarPorId();

                $result = array(
                    "success"   => true,
                    "msg"       => "Cadastrado com sucesso",
                    "data"      => $usuario = array('idusuario'=>$obj->getId(),'usuario'=>$obj->getUsuario(),'idpessoafisica'=> $obj->getObjPessoafisica()->getId(), 'idperfil'=>3, 'inatividade'=>'ativo')
                );
            }else{
                $objPFControl = new PessoaFisicaControl( new PessoaFisica($idPF) );
                $objPFControl->deletar();
                $result = array("success" => false, "msg" => "Ocorreu um erro, por favor, tente novamente!");
            }//fim if idUsuario
        }else{
            $result = array("success" => false, "msg" => "Ocorreu um erro, por favor, tente novamente!");
        }// fim if idPF
    }//fim de if obj

    echo json_encode($result);

}

function buscarUsuarioPorUsuario () {

        $data = $_POST['data'];

        $obj = new Usuario();
        $obj->setUsuario($data['usuario']);
        $control = new UsuarioControl($obj);
        $obj = $control->buscarPorUsuario();
        echo json_encode($obj);
    }


function redefinirSenha()
{
    $data = $_POST['data'];

    $obj = new Usuario($data['usuario']['idusuario']);
    $control = new UsuarioControl($obj);
    $usuario = $control->buscarPorId();
    if($usuario->getSenha() === $data['atual']){
        $usuario->setSenha($data['nova']);
        $usuario->setAtivo(0);
        $control->setOUsuario($usuario);
        $control->redefinir_senha();

        if($data['idadminempresa']){
            $ae = new AdminEmpresa($data['idadminempresa']);
            $ae->setObservacao("");
            $ae->setStatus('ATIVO');
            $aeCon = new AdminEmpresaControl($ae);
            $aeCon->trocarStatus();
        }

        echo json_encode(array('result' => true));
    }else{
        echo json_encode(array('result' => false));
    }
}

function ativarUsuario()
{
    $data = $_POST['data']['token'];
    $ae = new AdminEmpresa();
    $ae->setObservacao($data['data']['token']);
    $aeControl = new AdminEmpresaControl();
    $ae = $aeControl->checarToken();
    var_dump($ae);

//    $obj = new Usuario($data['usuario']['idusuario']);
//    $control = new UsuarioControl($obj);
//    $usuario = $control->buscarPorId();
//    if($usuario->getSenha() === $data['atual']){
//        $usuario->setSenha($data['nova']);
//        $usuario->setAtivo(0);
//        $control->setOUsuario($usuario);
//        $control->redefinir_senha();
//
//        echo json_encode(array('result' => true));
//    }else{
//        echo json_encode(array('result' => false));
//    }
}

