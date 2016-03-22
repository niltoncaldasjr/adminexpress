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

    $obj = new Honorario(
        NULL,
        new Servico($data['idservico']),
        stripslashes ( strip_tags( trim($data['valor']) ) )
    );
    $control = new HonorarioControl($obj);
    $id = $control->cadastrar();
    echo $id;

}
function atualizar () {
    $data = $_POST['data'];
    $obj = new Honorario(
        $data['id'],
        new Servico($data['idservico']),
        stripslashes ( strip_tags( trim($data['valor']) ) )
    );
    $control = new HonorarioControl($obj);
    echo $control->atualizar();
}
function listar () {
    $control = new HonorarioControl();
    $lista = $control->listar();
    if(!empty($lista)) {
        echo json_encode($lista);
    }
}
function deletar () {
    $data = $_POST['data'];
    $obj = new Honorario();
    $obj->setId($data['id']);
    $control = new HonorarioControl($obj);
    echo $control->deletar();
}
function buscarPorId () {

    $data = $_POST['data'];
    $control = new HonorarioControl(new Honorario($data[id]));
    $lista = $control->buscarPorId();
    if(!empty($lista)) {
        echo json_encode($lista);
    }
}