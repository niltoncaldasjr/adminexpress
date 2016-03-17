<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 17/03/2016. 
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

	$obj = new ContaBanco(
			NULL,
			stripslashes ( strip_tags( trim($data['agencia']) ) ),
			stripslashes ( strip_tags( trim($data['digitoAgencia']) ) ),
			stripslashes ( strip_tags( trim($data['numeroConta']) ) ),
			stripslashes ( strip_tags( trim($data['digitoConta']) ) ),
			stripslashes ( strip_tags( trim($data['numeroCarteira']) ) ),
			stripslashes ( strip_tags( trim($data['numeroConvenio']) ) ),
			stripslashes ( strip_tags( trim($data['nomeContato']) ) ),
			stripslashes ( strip_tags( trim($data['telefoneContato']) ) ),
			stripslashes ( strip_tags( trim($data['endereco']) ) ),
			new Banco($data['banco']['id'])
			);
	$control = new ContaBancoControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new ContaBanco(
			$data['id'],
			stripslashes ( strip_tags( trim($data['agencia']) ) ),
			stripslashes ( strip_tags( trim($data['digitoAgencia']) ) ),
			stripslashes ( strip_tags( trim($data['numeroConta']) ) ),
			stripslashes ( strip_tags( trim($data['digitoConta']) ) ),
			stripslashes ( strip_tags( trim($data['numeroCarteira']) ) ),
			stripslashes ( strip_tags( trim($data['numeroConvenio']) ) ),
			stripslashes ( strip_tags( trim($data['nomeContato']) ) ),
			stripslashes ( strip_tags( trim($data['telefoneContato']) ) ),
			stripslashes ( strip_tags( trim($data['endereco']) ) ),
			new Banco($data['banco']['id'])
		);
	$control = new ContaBancoControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new ContaBancoControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$banco = new ContaBanco();
	$banco->setId($data['id']);
	$control = new ContaBancoControl($banco);
	echo $control->deletar();	
}
function buscarPorId () {
	
}

?>