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
	$obj = new PessoaJuridica(
			NULL,
			stripslashes ( strip_tags( trim($data['objpessoa']) ) ),
			stripslashes ( strip_tags( trim($data['razao']) ) ),
			stripslashes ( strip_tags( trim($data['cnpj']) ) ),
			stripslashes ( strip_tags( trim($data['nire']) ) ),
			stripslashes ( strip_tags( trim($data['inscestadual']) ) ),
			stripslashes ( strip_tags( trim($data['inscmunicipal']) ) ),
			stripslashes ( strip_tags( trim($data['representante']) ) )
			);
	$control = new PessoaJuridicaControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new PessoaJuridica(
			$data['id'],
			stripslashes ( strip_tags( trim($data['objpessoa']) ) ),
			stripslashes ( strip_tags( trim($data['razao']) ) ),
			stripslashes ( strip_tags( trim($data['cnpj']) ) ),
			stripslashes ( strip_tags( trim($data['nire']) ) ),
			stripslashes ( strip_tags( trim($data['inscestadual']) ) ),
			stripslashes ( strip_tags( trim($data['inscmunicipal']) ) ),
			stripslashes ( strip_tags( trim($data['representante']) ) )
	);
	$control = new PessoaJuridicaControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new PessoaJuridicaControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$obj = new PessoaJuridica();
	$obj->setId($data['id']);
	$control = new PessoaJuridicaControl($obj);
	echo $control->deletar();	
}
function buscarPorId () {
	
}

?>