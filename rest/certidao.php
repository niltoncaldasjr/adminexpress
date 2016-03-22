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

    $obj = new Certidao(
        NULL,
        stripslashes ( strip_tags( trim($data['descricao']) ) ),
        stripslashes ( strip_tags( trim($data['prazo']) ) ),
        stripslashes ( strip_tags( trim($data['valor']) ) )
    );
    $control = new CertidaoControl($obj);
    $id = $control->cadastrar();
    echo $id;

}
function atualizar () {
    $data = $_POST['data'];
    $obj = new Certidao(
        $data['id'],
        stripslashes ( strip_tags( trim($data['descricao']) ) ),
        stripslashes ( strip_tags( trim($data['prazo']) ) ),
        stripslashes ( strip_tags( trim($data['valor']) ) )
    );
    $control = new CertidaoControl($obj);
    echo $control->atualizar();
}
function listar () {
    $control = new CertidaoControl();
    $lista = $control->listar();
    if(!empty($lista)) {
        echo json_encode($lista);
    }
}
function deletar () {
    $data = $_POST['data'];
    $obj = new Certidao();
    $obj->setId($data['id']);
    $control = new CertidaoControl($obj);
    echo $control->deletar();
}
function buscarPorId () {

    $data = $_POST['data'];
    $control = new CertidaoControl(new Certidao($data[id]));
    $lista = $control->buscarPorId();
    if(!empty($lista)) {
        echo json_encode($lista);
    }
}