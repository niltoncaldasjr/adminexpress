/**
 * INSPINIA - Responsive Admin Theme
 *
 */
function config($translateProvider) {

    $translateProvider
        .translations('pt', {

            // Define all menu elements
            HOME: 'CartórioExpressAM',
            CADASTROSGERAIS: 'Cadastros Gerais',
            AUTENTICACAO: 'Autenticação',
            CADASTROSADMINISTRATIVOS: 'Administrativos',
            UTILITARIOS: 'Utilitários',
            SERVICOS: 'Serviços',
            STATUSPROCESSO: 'Status de Processos',
            INDICACOES: 'Indicações',
            CORRETORES: 'Corretores',
            BANCOAGENCIA: 'Banco / Agência',
            CARTORIO: 'Cartório',
            ORGAOS: 'Orgãos',
            CERTIDOES: 'Certidões',
            CLIENTE: 'Cliente',
            PROCESSO: 'Processo',
            ANDAMENTODOPROCESSO: 'Andamento do Processo',
            CONTACORRENTE: 'Conta Corrente',
            CLIENTEEMPOTENCIAL: 'Cliente em Potencial',
            PEDIDODECERTIDAO: 'Pedido de Certidão',
            USUARIO: 'Usuário',
            PERFIL: 'Perfil',
            MENU: 'Menu',
            PERMISSOES: 'Permissões',
            ARQUIVOVIRTUAL: 'Arquivo Virtual',
            BOLETO: 'Boleto',
            PARAMETROSDOSISTEMA: 'Parametros do Sistema',
            RELATORIOS: 'Relatórios',
            PROCESSOS: 'Processos',
            SEARCH: 'Buscar por algo...',
            LANGUAGE: 'Idioma',
            LOGOUT: 'Sair',
            HONORARIO: 'Honorário',
            CHECKLIST: 'Checklist',
            ORDEMDESERVICO: 'Ordem de Serviço'


        })
        .translations('en', {

            // Define all menu elements
            HOME: 'CartórioExpressAM',
            CADASTROSGERAIS: 'General entries',
            AUTENTICACAO: 'Authentication',
            CADASTROSADMINISTRATIVOS: 'Administrative',
            UTILITARIOS: 'Utilities',
            SERVICOS: 'Services',
            STATUSPROCESSO: 'Process Status',
            INDICACOES: 'Indications',
            CORRETORES: 'Brokers',
            BANCOAGENCIA: 'Bank / Agency',
            CARTORIO: 'Registry',
            ORGAOS: 'Organs',
            CERTIDOES: 'Certificates',
            CLIENTE: 'Client',
            PROCESSO: 'Processo',
            ANDAMENTODOPROCESSO: 'Process Underway',
            CONTACORRENTE: 'Current Account',
            CLIENTEEMPOTENCIAL: 'Customer Potential',
            PEDIDODECERTIDAO: 'Certificate Request',
            USUARIO: 'User',
            PERFIL: 'Profile',
            MENU: 'Menu',
            PERMISSOES: 'Permissions',
            ARQUIVOVIRTUAL: 'Virtual File',
            BOLETO: 'Billet',
            PARAMETROSDOSISTEMA: 'Parameters System',
            RELATORIOS: 'Reports',
            PROCESSOS: 'Processes',
            SEARCH: 'Search for something ...',
            LANGUAGE: 'Language',
            LOGOUT: 'Log out',
            HONORARIO: 'Honorário',
            CHECKLIST: 'Checklist',
            ORDEMDESERVICO: 'Order of Service'
        });

    $translateProvider.preferredLanguage('pt');

}

angular
    .module('admin-express')
    .config(config)
