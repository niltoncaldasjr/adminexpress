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
    case 'deletar':
        deletar();
        break;
}

function listarTodos()
{
    $control = new OrcamentoControl();
    $todos = $control->listar();

    echo json_encode($todos);
}

function buscarPorId()
{
    $data = $_POST['data'];
    $control = new OrcamentoControl(new Orcamento($data));
    $todos = $control->buscarPorId();

    echo json_encode($todos);
}

function deletar()
{
    $data = $_POST['data'];
    $control = new OrcamentoControl(new Orcamento($data));
    $todos = $control->deletar();

    echo json_encode(array('result'=>$todos));
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
    $orc = new Orcamento();
    $orc->setIdcliente(new Pessoa($data['idcliente']['id']))
        ->setIdservico(new Servico($data['idservico']['id']))
        ->setIdusuario(new Usuario("1"))
        ->setDesconto($data['desconto'])
        ->setSubtotal($data['subtotal'])
        ->setTotal($data['total'])
        ->setObservacao($data['observacao'])
        ->setStatus(1);

    $orcControl = new OrcamentoControl($orc);
    $orc->setId($orcControl->cadastrar());

    $itens = $data['itensdeorcamento'];

    foreach ($itens as $item):
        $itemorc = new ItensDeOrcamento();
        $itemorc->setObjOrcamento(new Orcamento($orc->getId()))
            ->setObjServico(new Servico($item['idservico']['id']))
            ->setQuantidade($item['quantidade']);
        $itemControl = new ItensDeOrcamentoControl($itemorc);
        $itemControl->cadastrar();
    endforeach;


    echo json_encode(array('result' => 'true'));

}

function atualizar()
{
    $data = $_POST['data'];
    $orc = new Orcamento();

    $orc->setId($data['id'])
        ->setIdcliente(new Pessoa($data['idcliente']['id']))
        ->setIdservico(new Servico($data['idservico']['id']))
        ->setIdusuario(new Usuario("1"))
        ->setDesconto($data['desconto'])
        ->setSubtotal($data['subtotal'])
        ->setTotal($data['total'])
        ->setObservacao($data['observacao'])
        ->setStatus(1);

    $orcControl = new OrcamentoControl($orc);
    $orcControl->atualizar();

    $itens = $data['itensdeorcamento'];

    foreach ($itens as $item):
        if ($item['id'] == 0)
        {
            $itemorc = new ItensDeOrcamento();
            $itemorc->setObjOrcamento(new Orcamento($orc->getId()))
                ->setObjServico(new Servico($item['idservico']['id']))
                ->setQuantidade($item['quantidade']);
            $itemControl = new ItensDeOrcamentoControl($itemorc);
            $itemControl->cadastrar();
        }else{
            $itemorc = new ItensDeOrcamento($item['id']);
            $itemorc->setQuantidade($item['quantidade']);
            $itemControl = new ItensDeOrcamentoControl($itemorc);
            $itemControl->atualizar();
        }
    endforeach;


    echo json_encode(array('result' => 'true'));
}