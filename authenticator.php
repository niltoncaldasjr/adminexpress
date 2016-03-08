<?php
session_start();

/*
    Recebe o POST enviado por AJAX
*/
if(!$_POST){ // Se POST estiver vazio.
    $_POST = json_decode ( file_get_contents ( "php://input" ), true ); //convertendo em array
}

/*
    Debug: Descomentar a linha abaixo para depurar resposta da API
*/
// echo communicator();exit;

/*
    Verifica o mmétodo requisitado
*/
switch ($_POST['metodo']) {

    /*
        Requisições de autenticação
    */
    case 'logarCupom':
        logarCupom();
        break;

    case 'logout':
        logout();
        break;

    case 'verificaSessao':
        verificaSessao();
        break;

    case 'cadastrarUsuarioCupom':
        cadastrarUsuarioCupom();
        break;

    case 'validarUsuario':
        validarUsuario();
        break;

    /*
        Requisições genericas
    */
    default:
        echo json_encode(array("success" => false, "msg" => "ERROR: *". $_POST['metodo'] . "* não existe em authenticator.php"));
        break;
}

/*
    Função generica do Communicator
*/
function communicator () {
    $content = http_build_query(array(
        'metodo' => $_POST['metodo'],
        'data' =>   $_POST['data'],
        'class' =>  $_POST['class']
    ));
    $context = stream_context_create(array(
        'http' => array(
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                "Content-Length: ".strlen($content)."\r\n".
                "User-Agent:MyAgent/1.0\r\n",
            'method'  => 'POST',
            'content' => $content
        )
    ));

    return file_get_contents("http://api.nuvio.com.br/src/api.php", null, $context);
}

/*
    Logar da authenticação
*/
function cadastrarUsuarioCupom () {
    /*
        Função generica do Communicator
    */
    // echo communicator ();
    $result = json_decode(communicator (), true);

    if($result['success'] == true) {
        $_SESSION['usuario'] = $result['data'];
        echo json_encode($result);
    }else{
        $result["success"] = false;
        echo json_encode($result);
    }
}


/*
    Logar da authenticação
*/
function logarCupom () {
    /*
        Função generica do Communicator
    */
    $result = json_decode(communicator (), true);

    if($result['metodo'] == "logar" && $result['success'] == true) {
        $_SESSION['usuario'] = $result['data'];
        echo json_encode($result);
    }else{
        $result["success"] = false;
        echo json_encode($result);
    }
}

/*
    Vericador de sessão
*/
function verificaSessao () {
    if(isset($_SESSION['usuario'])) {
        echo json_encode($_SESSION['usuario']);
    }
}

/*
    logout(destroy a sessão ativa)
*/
function logout () {
    $_SESSION = array();
    session_destroy();
    echo true;
}

function validarUsuario()
{
    var_dump($_POST);
}