<?php
/*
	Verifica métodos requisitado
*/

switch ($_POST['metodo']) {

    case 'trazer_perfil':
        trazer_perfil();
        break;

    default:
        break;
}

function trazer_perfil()
{
    $data = $_POST['data'];

    $obj = new PessoaFisica($data['idpessoafisica']);
    $objControl = new PessoaFisicaControl( $obj );
    $objpf = $objControl->buscarPorId();

    /** @var $array_nome pegar o primeiro e o ultimo nome da pessoa */
    $array_nome =explode(" ",$objpf->getNome());
    $nome = array('nome' => $array_nome[0] . " " . $array_nome[count($array_nome)- 1]);

    $perfil = new Perfil($data['idperfil']);
    $pControl = new PerfilControl($perfil);
    $perfil = $pControl->buscarPorId();

    $src = 'http://api.nuvio.com.br/img/uploads/pf/' . $data['idusuario'] . '.png';

    if (file_exists($src)) { $src = $src; }
    else{ $src = 'http://api.nuvio.com.br/img/uploads/pf/default.jpg'; }

    $data = array(
        'pessoa' => $nome,
        'perfil' => $perfil ,
        'img' => $src
    );

    echo json_encode( $data );


}
