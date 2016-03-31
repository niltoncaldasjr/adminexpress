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
	
	$idpessoa = cadPessoa($data);
	echo $idpessoa;exit;
	
	if($data['grupo']['tipo']=='PJ') {
		cadPJ($data, $idpessoa);
	}else{
		cadPF($data, $idpessoa);
	}
	
	$obj = new GrupoPessoa(
			NULL,
			$data['objgrupo'],
			$idpessoa,
			stripslashes ( strip_tags( trim($data['descricao']) ) ),
			stripslashes ( strip_tags( trim($data['febran']) ) )
			);
	$control = new GrupoPessoaControl($obj);
	$id = $control->cadastrar();
	echo $id;
	
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new GrupoPessoa(
			$data['id'],
			stripslashes ( strip_tags( trim($data['descricao']) ) ),
			stripslashes ( strip_tags( trim($data['febran']) ) )
	);
	$control = new GrupoPessoaControl($obj);
	echo $control->atualizar();
}
function listar () {
	$control = new GrupoPessoaControl();
	$lista = $control->listar();
	if(!empty($lista)) {
		echo json_encode($lista);
	}
}
function deletar () {
	$data = $_POST['data'];
	$banco = new GrupoPessoa();
	$banco->setId($data['id']);
	$control = new GrupoPessoaControl($banco);
	echo $control->deletar();	
}
function buscarPorId () {
	
}

/*
	Cadastros das classes Pessoa
*/
function cadPessoa ($data) {
	$objPessoa = new Pessoa(
			NULL,
			stripslashes ( strip_tags( trim($data['pessoa']['CEP']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['endereco']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['endereco']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['numero']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['complemento']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['bairro']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['telefone']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['fax']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['celular']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['email1']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['email2']) ) ),
			stripslashes ( strip_tags( trim($data['pessoa']['site']) ) )
	);
	$pessoaControl = new PessoaControl($objPessoa);
	$idpessoa = $pessoaControl->cadastrar();
	return $idpessoa;
}
function cadPF ($data, $idpessoa) {
	$objPF = new PessoaFisica(
			NULL,
			$idpessoa,
			stripslashes ( strip_tags( trim($data['pessoapf']['nome']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['cpf']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['nacionalidade']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['datanascimento']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['estadocivil']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['nomeconjuge']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['profissao']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['tipodoc']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['numerodoc']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['orgaodoc']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['dataemissaodoc']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['pai']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['mae']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapf']['sexo']) ) )
	);
	$pfControl = new PessoaFisicaControl($objPF);
	return $pfControl->cadastrar();
}
function cadPJ ($data, $idpessoa) {
	$objPJ = new PessoaJuridica(
			NULL,
			$idpessoa,
			stripslashes ( strip_tags( trim($data['pessoapj']['razao']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapj']['cnpj']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapj']['nire']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapj']['inscestadual']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapj']['inscmunicipal']) ) ),
			stripslashes ( strip_tags( trim($data['pessoapj']['representante']) ) )
			);
	$pjControl = new PessoaJuridicaControl($objPJ);
	return $pjControl->cadastrar();
}
function cadRepPJ ($data, $idpj) {
	
	$reps = $data['pessoapj']['representantes'];
	
	foreach ($reps as $key) {
		$idpessoa = cadPessoa($data);
		$idpf = cadPF ($data, $idpessoa);
		
		$objRepPJ = new RepresentantePJ(
				NULL,
				$idpj,
				$idpf,
				stripslashes ( strip_tags( trim($key['funcao']) ) ),
				stripslashes ( strip_tags( trim($key['representante']) ) )
		);
		$repControl = new RepresentantePJControl($objRepPJ);
		$repControl->cadastrar();
	}
}

?>