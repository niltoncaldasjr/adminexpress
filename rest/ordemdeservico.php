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
    case 'listarclientes':
        listarClientes();
        break;
    case 'listartodos':
        listarTodos();
        break;
    case 'buscarporid':
        buscarPorId();
        break;
}

function listarTodos()
{
    $control = new OrdemDeServicoControl();
    $todos = $control->listarTodos();

    echo json_encode($todos);
}

function listarClientes()
{
    $data = $_POST['data'];

    $control = new PessoaControl();
    $clientes = $control->listarJuntos($data['busca']);

    echo json_encode($clientes);
}

function cadastrar()
{
    $data = $_POST['data'];
    $os = new OrdemDeServico();
    $os->setObjpessoa(new Pessoa($data['idcliente']['id']))
        ->setObjservico(new Servico($data['idservico']['id']))
        ->setObjusuario(new Usuario("1"))
        ->setAndamento('Parado na 8º Vara')
        ->setDesconto($data['desconto'])
        ->setSubtotal($data['subtotal'])
        ->setTotal($data['total'])
        ->setObservacao($data['observacao'])
        ->setStatus(1);

    $osControl= new OrdemDeServicoControl($os);
    $os->setId( $osControl->cadastrar());
//    $os->setId(4);

    $itens = $data['itensdeservico'];
    $participantes = $data['participantes'];
    $checklists = $data['checklists'];
    $andamentos = $data['andamentos'];

    foreach ($itens as $item):
        $servico = new OsItensDeServico();
        $servico->setObjOrdemdeservico(new OrdemDeServico($os->getId()))
            ->setObjServico(new Servico($item['id']))
            ->setQuantidade($item['qtde']);
        $itemControl = new OsItensDeServicoControl($servico);
        $itemControl->cadastrar();
    endforeach;

    foreach ($participantes as $part):
        $pessoa = new OsParticipantes();
        $pessoa->setObjOrdemdeservico(new OrdemDeServico($os->getId()))
            ->setObjPessoa(new Pessoa($part['id']))
            ->setFuncao(1);
        $partControl = new OsParticipantesControl($pessoa);
        $partControl->cadastrar();
    endforeach;

    foreach ($checklists as $chk):
        $osChk = new OsChecklist();
        $osChk->setObjOrdemdeservico(new OrdemDeServico($os->getId()))
            ->setObjChecklist(new Pessoa($chk['id']))
            ->setStatus($chk['status']);
        $chkControl = new OsChecklistControl($osChk);
        $chkControl->cadastrar();
    endforeach;

    foreach ($andamentos as $andam):
        $osAndam = new OsAndamento();
        $osAndam->setObjOrdemdeservico(new OrdemDeServico($os->getId()))
            ->setObjStatusprocesso(new StatusProcesso($andam['idstatusprocesso']['id']))
            ->setDescricao($andam['descricao']);
        $andControl = new OsAndamentoControl($osAndam);
        $andControl->cadastrar();
    endforeach;


    echo json_encode(array('result'=>'true'));
    
//    echo "<pre>";
//    var_dump($data);
}
function atualizar()
{
    $data = $_POST['data'];
    var_dump($data);
}