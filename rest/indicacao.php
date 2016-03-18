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

	$obj = new Indicacao(
			NULL,
			stripslashes ( strip_tags( trim($data['nome']) ) ),
			stripslashes ( strip_tags( trim($data['cep']) ) ),
			stripslashes ( strip_tags( trim($data['endereco']) ) ),
			stripslashes ( strip_tags( trim($data['numero']) ) ),
			stripslashes ( strip_tags( trim($data['complemento']) ) ),
			stripslashes ( strip_tags( trim($data['bairro']) ) ),
			stripslashes ( strip_tags( trim($data['cidade']) ) ),
			stripslashes ( strip_tags( trim($data['uf']) ) ),
			stripslashes ( strip_tags( trim($data['telefone']) ) ),
			stripslashes ( strip_tags( trim($data['email1']) ) ),
			stripslashes ( strip_tags( trim($data['email2']) ) ),
			stripslashes ( strip_tags( trim($data['celular1']) ) ),
			stripslashes ( strip_tags( trim($data['celular2']) ) ),
			stripslashes ( strip_tags( trim($data['atividade']) ) ),
			stripslashes ( strip_tags( trim($data['observacao']) ) ),
			stripslashes ( strip_tags( trim($data['senhaweb']) ) )
			);
	$control = new IndicacaoControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new Indicacao(
			$data['id'],
			stripslashes ( strip_tags( trim($data['nome']) ) ),
			stripslashes ( strip_tags( trim($data['cep']) ) ),
			stripslashes ( strip_tags( trim($data['endereco']) ) ),
			stripslashes ( strip_tags( trim($data['numero']) ) ),
			stripslashes ( strip_tags( trim($data['complemento']) ) ),
			stripslashes ( strip_tags( trim($data['bairro']) ) ),
			stripslashes ( strip_tags( trim($data['cidade']) ) ),
			stripslashes ( strip_tags( trim($data['uf']) ) ),
			stripslashes ( strip_tags( trim($data['telefone']) ) ),
			stripslashes ( strip_tags( trim($data['email1']) ) ),
			stripslashes ( strip_tags( trim($data['email2']) ) ),
			stripslashes ( strip_tags( trim($data['celular1']) ) ),
			stripslashes ( strip_tags( trim($data['celular2']) ) ),
			stripslashes ( strip_tags( trim($data['atividade']) ) ),
			stripslashes ( strip_tags( trim($data['observacao']) ) ),
			stripslashes ( strip_tags( trim($data['senhaweb']) ) )
		);
	$control = new IndicacaoControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new IndicacaoControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$obj = new Indicacao($_POST['data']);
	$obj->setId($data['id']);
	$control = new IndicacaoControl($obj);
	echo $control->deletar();	
}
function buscarPorId () {
	
}

?>