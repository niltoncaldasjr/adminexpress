<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
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

	$obj = new StatusProcesso(
			NULL,
			stripslashes ( strip_tags( trim($data['nome']) ) ),
			stripslashes ( strip_tags( trim($data['web']) ) )
			);
	$control = new StatusProcessoControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new StatusProcesso(
			$data['id'],
			stripslashes ( strip_tags( trim($data['nome']) ) ),
			stripslashes ( strip_tags( trim($data['web']) ) )
		);
	$control = new StatusProcessoControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new StatusProcessoControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$obj = new StatusProcesso();
	$obj->setId($data['id']);
	$control = new StatusProcessoControl($obj);
	echo $control->deletar();	
}
function buscarPorId () {
	
}

?>