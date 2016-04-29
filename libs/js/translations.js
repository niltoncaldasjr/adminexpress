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
            CHECKLIST: 'Checklist'


        })
        .translations('en', {

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
            LANGUAGE: 'Language',
            LOGOUT: 'Log out',
            HONORARIO: 'Honorário',
            CHECKLIST: 'Checklist'
        });

    $translateProvider.preferredLanguage('pt');

}

angular
    .module('admin-express')
    .config(config)
