<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarães Monteiro.
 	Data de início: 08/03/2016.
 	Data Atual: 01/03/2016. 
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
	case 'listarPorGrupo':
		listarPorGrupo();
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
	
	$idpessoa = cadPessoa($data['pessoa']);
	
	if($data['grupo']['tipo']=='PJ') {
		$idpj = cadPJ($data['pessoapj'], $idpessoa);
		cadRepPJ($data['pessoapj']['representantes'], $idpj);
	}else{
		cadPF($data['pessoapf'], $idpessoa);
	}
	
	$obj = new GrupoPessoa(
			NULL,
			new Grupo($data['grupo']['id']),
			new Pessoa($idpessoa),
			stripslashes ( strip_tags( trim($data['grupopessoa']['informacao']) ) )
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
function listarPorGrupo () {
	$data = $_POST['data'];
	$obj = new GrupoPessoa(); $obj->setObjgrupo(new Grupo($data['id']));
	$control = new GrupoPessoaControl($obj);
	$lista = $control->listarPorGrupo();
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
function cadPessoa ($pessoa) {
	$objPessoa = new Pessoa(
			NULL,
			stripslashes ( strip_tags( trim($pessoa['CEP']) ) ),
			stripslashes ( strip_tags( trim($pessoa['tipo']) ) ),
			stripslashes ( strip_tags( trim($pessoa['endereco']) ) ),
			stripslashes ( strip_tags( trim($pessoa['endereco']) ) ),
			stripslashes ( strip_tags( trim($pessoa['numero']) ) ),
			stripslashes ( strip_tags( trim($pessoa['complemento']) ) ),
			stripslashes ( strip_tags( trim($pessoa['bairro']) ) ),
			stripslashes ( strip_tags( trim($pessoa['telefone']) ) ),
			stripslashes ( strip_tags( trim($pessoa['fax']) ) ),
			stripslashes ( strip_tags( trim($pessoa['celular']) ) ),
			stripslashes ( strip_tags( trim($pessoa['email1']) ) ),
			stripslashes ( strip_tags( trim($pessoa['email2']) ) ),
			stripslashes ( strip_tags( trim($pessoa['site']) ) )
	);
	$pessoaControl = new PessoaControl($objPessoa);
	$idpessoa = $pessoaControl->cadastrar();
	return $idpessoa;
}
function cadPF ($pf, $idpessoa) {
	
	$objPF = new PessoaFisica(
			NULL,
			new Pessoa($idpessoa),
			stripslashes ( strip_tags( trim($pf['nome']) ) ),
			stripslashes ( strip_tags( trim($pf['cpf']) ) ),
			stripslashes ( strip_tags( trim($pf['nacionalidade']) ) ),
			stripslashes ( strip_tags( trim($pf['naturalidade']) ) ),
			stripslashes ( strip_tags( trim($pf['datanascimento']) ) ),
			stripslashes ( strip_tags( trim($pf['estadocivil']) ) ),
			stripslashes ( strip_tags( trim($pf['nomeconjuge']) ) ),
			new Profissao($pf['objprofissao']['id']),
			stripslashes ( strip_tags( trim($pf['tipodoc']) ) ),
			stripslashes ( strip_tags( trim($pf['numerodoc']) ) ),
			stripslashes ( strip_tags( trim($pf['orgaodoc']) ) ),
			stripslashes ( strip_tags( trim($pf['dataemissaodoc']) ) ),
			stripslashes ( strip_tags( trim($pf['pai']) ) ),
			stripslashes ( strip_tags( trim($pf['mae']) ) ),
			stripslashes ( strip_tags( trim($pf['sexo']) ) )
	);
	$pfControl = new PessoaFisicaControl($objPF);
	$pfControl->cadastrar();
	return $idpessoa;
}
function cadPJ ($pj, $idpessoa) {
	$objPJ = new PessoaJuridica(
			NULL,
			new Pessoa($idpessoa),
			stripslashes ( strip_tags( trim($pj['razao']) ) ),
			stripslashes ( strip_tags( trim($pj['cnpj']) ) ),
			stripslashes ( strip_tags( trim($pj['nire']) ) ),
			stripslashes ( strip_tags( trim($pj['inscestadual']) ) ),
			stripslashes ( strip_tags( trim($pj['inscmunicipal']) ) )
// 			stripslashes ( strip_tags( trim($data['pessoapj']['representante']) ) )
			);
	$pjControl = new PessoaJuridicaControl($objPJ);
	$pjControl->cadastrar();
	return $idpessoa;
}
function cadRepPJ ($reps, $idpj) {
	
	foreach ($reps as $rep) {
		$idpessoa = cadPessoa($rep['pf']['pessoa']);
		$idpf = cadPF ($rep['pf'], $idpessoa);
		
		$objRepPJ = new RepresentantePJ(
				NULL,
				new Pessoa($idpj),
				new Pessoa($idpf),
				stripslashes ( strip_tags( trim($rep['funcao']) ) ),
				stripslashes ( strip_tags( trim($rep['representante']) ) )
		);
		$repControl = new RepresentantePJControl($objRepPJ);
		return $repControl->cadastrar();
	}
}

?>