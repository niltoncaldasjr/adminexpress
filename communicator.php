<?php
session_start();

/*
    Recebe o POST enviado por AJAX
*/
if(!$_POST){ // Se POST estiver vazio.
    $_POST = json_decode ( file_get_contents ( "php://input" ), true ); //convertendo em array
}


generic();

/*
    Função generica
*/
function generic () {

    /*
       Verifica se a requisição exige sessão
   */
    if($_POST['session']) { // exige sessao
        /*
            Se haver sessão permitimos
            o acesso ao communicator
        */
        if(isset($_SESSION['usuario'])) echo communicator();
    }else{ // não exige sessao
        echo communicator();
    }
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

    return file_get_contents("rest/autoload.php", null, $context);
}