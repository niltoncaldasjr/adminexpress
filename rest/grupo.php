<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 08/03/2016. 
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
	case 'buscarPorDescricao':
		buscarPorDescricao();
		break;
}

/* Metodos */
function cadastrar () {
	$data = $_POST['data'];
	$obj = new Grupo(
			NULL,
			stripslashes ( strip_tags( trim($data['descricao']) ) ),
			stripslashes ( strip_tags( trim($data['febran']) ) )
			);
	$control = new GrupoControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new Grupo(
			$data['id'],
			stripslashes ( strip_tags( trim($data['descricao']) ) ),
			stripslashes ( strip_tags( trim($data['febran']) ) )
	);
	$control = new GrupoControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new GrupoControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$banco = new Grupo();
	$banco->setId($data['id']);
	$control = new GrupoControl($banco);
	echo $control->deletar();	
}
function buscarPorId () {
	
}
function buscarPorDescricao () {
	$data = $_POST['data'];
	$obj = new Grupo();
	$obj->setDescricao($data);
	$control = new GrupoControl($obj);
	$obj = $control->buscarPorDescricao();
	if($obj) {
		echo json_encode($obj);
	}
}

?>