<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
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
	$obj = new Pessoa(
			NULL,
			stripslashes ( strip_tags( trim($data['CEP']) ) ),
			stripslashes ( strip_tags( trim($data['endereco']) ) ),
			stripslashes ( strip_tags( trim($data['numero']) ) ),
			stripslashes ( strip_tags( trim($data['complemento']) ) ),
			stripslashes ( strip_tags( trim($data['bairro']) ) ),
			stripslashes ( strip_tags( trim($data['telefone']) ) ),
			stripslashes ( strip_tags( trim($data['fax']) ) ),
			stripslashes ( strip_tags( trim($data['celular']) ) ),
			stripslashes ( strip_tags( trim($data['email']) ) ),
			stripslashes ( strip_tags( trim($data['email2']) ) ),
			stripslashes ( strip_tags( trim($data['site']) ) )
			);
	$control = new PessoaControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new Pessoa(
			$data['id'],
			stripslashes ( strip_tags( trim($data['CEP']) ) ),
			stripslashes ( strip_tags( trim($data['endereco']) ) ),
			stripslashes ( strip_tags( trim($data['numero']) ) ),
			stripslashes ( strip_tags( trim($data['complemento']) ) ),
			stripslashes ( strip_tags( trim($data['bairro']) ) ),
			stripslashes ( strip_tags( trim($data['telefone']) ) ),
			stripslashes ( strip_tags( trim($data['fax']) ) ),
			stripslashes ( strip_tags( trim($data['celular']) ) ),
			stripslashes ( strip_tags( trim($data['email']) ) ),
			stripslashes ( strip_tags( trim($data['email2']) ) ),
			stripslashes ( strip_tags( trim($data['site']) ) )
	);
	$control = new PessoaControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new PessoaControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$obj = new Pessoa();
	$obj->setId($data['id']);
	$control = new PessoaControl($obj);
	echo $control->deletar();	
}
function buscarPorId () {
	
}

?>