<?php


/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimar�es Monteiro.
 	Data de in�cio: 08/03/2016.
 	Data Atual: 16/03/2016. 
*/

/* Inclui a Class de autoLoad */
require_once 'autoload.php';

/* Metodo requisitado */
switch ($_POST['metodo']) {
    case 'cadastrar':
        cadastrar();
        break;
    case 'atualizar':
        atualizar();
        break;
    case 'listarclientes':
        listarClientes();
        break;
    case 'deletar':
        deletar();
        break;
    case 'buscarPorId':
        buscarPorId();
        break;
}

function listarClientes(){

    $data = $_POST['data'];
    
    $control = new PessoaControl();
    $clientes = $control->listarJuntos($data['busca']);

//    echo json_encode(array('data'=>$clientes));
    echo json_encode($clientes);
}