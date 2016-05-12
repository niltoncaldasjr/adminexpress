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
	case 'listar':
		listar();
		break;
	case 'listarLikePf':
		listarLikePf();
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
	$obj = new PessoaFisica(
			NULL,
			stripslashes ( strip_tags( trim($data['objpessoa']) ) ),
			stripslashes ( strip_tags( trim($data['nome']) ) ),
			stripslashes ( strip_tags( trim($data['cpf']) ) ),
			stripslashes ( strip_tags( trim($data['nacionalidade']) ) ),
			stripslashes ( strip_tags( trim($data['naturalidade']) ) ),
			stripslashes ( strip_tags( trim($data['datanascimento']) ) ),
			stripslashes ( strip_tags( trim($data['estadocivil']) ) ),
			stripslashes ( strip_tags( trim($data['nomeconjuge']) ) ),
			stripslashes ( strip_tags( trim($data['profissao']) ) ),
			stripslashes ( strip_tags( trim($data['tipodoc']) ) ),
			stripslashes ( strip_tags( trim($data['numerodoc']) ) ),
			stripslashes ( strip_tags( trim($data['orgaodoc']) ) ),
			stripslashes ( strip_tags( trim($data['dataemissaodoc']) ) ),
			stripslashes ( strip_tags( trim($data['pai']) ) ),
			stripslashes ( strip_tags( trim($data['mae']) ) ),
			stripslashes ( strip_tags( trim($data['sexo']) ) )
			);
	$control = new PessoaFisicaControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new PessoaFisica(
			$data['id'],
			stripslashes ( strip_tags( trim($data['objpessoa']) ) ),
			stripslashes ( strip_tags( trim($data['nome']) ) ),
			stripslashes ( strip_tags( trim($data['cpf']) ) ),
			stripslashes ( strip_tags( trim($data['nacionalidade']) ) ),
			stripslashes ( strip_tags( trim($data['naturalidade']) ) ),
			stripslashes ( strip_tags( trim($data['datanascimento']) ) ),
			stripslashes ( strip_tags( trim($data['estadocivil']) ) ),
			stripslashes ( strip_tags( trim($data['nomeconjuge']) ) ),
			stripslashes ( strip_tags( trim($data['profissao']) ) ),
			stripslashes ( strip_tags( trim($data['tipodoc']) ) ),
			stripslashes ( strip_tags( trim($data['numerodoc']) ) ),
			stripslashes ( strip_tags( trim($data['orgaodoc']) ) ),
			stripslashes ( strip_tags( trim($data['dataemissaodoc']) ) ),
			stripslashes ( strip_tags( trim($data['pai']) ) ),
			stripslashes ( strip_tags( trim($data['mae']) ) ),
			stripslashes ( strip_tags( trim($data['sexo']) ) )
	);
	$control = new PessoaFisicaControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new PessoaFisicaControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function listarLikePf () {
	$data = $_POST['data'];
	$obj = new PessoaFisica();
	$obj->setNome($data['nome']);
	$control = new PessoaFisicaControl($obj);
	$lista = $control->listarPorNome();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$obj = new PessoaFisica();
	$obj->setId($data['id']);
	$control = new PessoaFisicaControl($obj);
	echo $control->deletar();	
}
function buscarPorId () {
	
}

?>