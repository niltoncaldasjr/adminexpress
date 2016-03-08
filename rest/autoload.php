<?php

/*
 	Projeto: AdminExpress.
 	Project Owner: Diego.
 	Gerente de Desenvolvimento: Nilton Caldas Jr.
 	Desenvolverdor: Fabiano Ferreira da Silva Costa
 	Desenvolverdor: Adelson Guimarгes Monteiro.
 	Data de inнcio: 08/03/2016.
 	Data Atual: 08/03/2016. 
*/

/* Trata $_POST */
if(!$_POST){ $_POST =  file_get_contents ( "php://input" ); }
$_POST = json_decode ($_POST, true);

/*
	Require da Conexгo
*/
require_once("../util/Conexao.php");

/*
	Funзгo AutoLoad, Carrega as Classes quando
	tenta-se criar uma nova instancia de uma Classe.
	Exemplo: new Cupom(), new UsuarioDAO(), new EmpresaControl()... 
*/
function carregaClasses($class){ 
	/*
		Verifica se existe "Control" no nome da classe
	*/
 	if(strripos($class, "Control")) {
 		/*	require na Control */
 		require_once("../control/".$class.".php");
 	}
 	/*
		Verifica se existe "Control" no nome da classe
	*/
 	else if(strripos($class, "DAO")) {
 		/* Monta o nome da Bean */
 		$bean = strtolower(substr($class, 0, strripos($class, "DAO")));
 		/*	require na DAO */
 		require_once("../model/".$bean."/".$class.".php");
 	/*
		Se nгo for DAO nem Control й Model.
	*/
 	}else{
 		/* Monta o nome da Bean */
 		$bean = strtolower($class);
 		/*	require na model */
 		require_once("../model/".$bean."/".$class.".php");
 	}
}

/*
	Chama o AutoLoad
*/
spl_autoload_register("carregaClasses");

/*
	Geta o Rest
*/
function getRest($class) {
	if($class) {
		require_once $class.".php";
	}
}

/*
	Chama a funзгo GetRest
*/
getRest($_POST['class']);

?>