<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimar�es Monteiro.
 	Data de in�cio: 08/03/2016.
 	Data Atual: 18/03/2016. 
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
    case 'listar':
        listar();
        break;
    case 'listarporservico':
        listarPorServico();
        break;
    case 'deletar':
        deletar();
        break;
    case 'buscarPorId':
        buscarPorId();
        break;
}

/* Metodos */
function cadastrar () {
    $data = $_POST['data'];

    $obj = new Checklist(
        NULL,
        new Servico($data['idservico']),
        stripslashes ( strip_tags( trim($data['ordem']) )),
        stripslashes ( strip_tags( trim($data['item']) ) )
    );
    $control = new ChecklistControl($obj);
    $id = $control->cadastrar();
    echo $id;

}
function atualizar () {
    $data = $_POST['data'];
    $obj = new Checklist(
        $data['id'],
        new Servico($data['idservico']),
        stripslashes ( strip_tags( trim($data['ordem']) )),
        stripslashes ( strip_tags( trim($data['item']) ) )
    );
    $control = new ChecklistControl($obj);
    echo $control->atualizar();
}
function listar () {
    $control = new ChecklistControl();
    $lista = $control->listar();
    if(!empty($lista)) {
        echo json_encode($lista);
    }
}
function listarPorServico () {
    $data = $_POST['data'];
    $obj = new Checklist(
        NULL,
        new Servico($data['id'])
    );
    $control = new ChecklistControl($obj);
    $lista = $control->listarPorServico();
    if(!empty($lista)) {
        echo json_encode($lista);
    }
}

function deletar () {
    $data = $_POST['data'];
    $obj = new Checklist();
    $obj->setId($data['id']);
    $control = new ChecklistControl($obj);
    echo $control->deletar();
}
function buscarPorId () {

    $data = $_POST['data'];
    $control = new ChecklistControl(new Checklist($data[id]));
    $lista = $control->buscarPorId();
    if(!empty($lista)) {
        echo json_encode($lista);
    }
}