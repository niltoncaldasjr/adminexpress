angular.module('admin-express')
    .controller('ordemDeServicoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        $scope.os = {
            'id': 1, 'data': '2016-05-12 00:00', 'cliente': {
                'id': 1, 'nome': 'Fabio Lucena'
            },
            'servico': {'id': 1, 'nome': 'Servico Principal', 'valor': 810},
            'observacao': 'Obs...',
            'itensdeservico': [
                {'id': 123, 'nome': 'Compra de Imóvel', 'valor': 26, 'qtde': 2},
                {'id': 25, 'nome': 'Reconhecimento de Firma', 'valor': 80, 'qtde': 1},
                {'id': 28, 'nome': 'ITBI', 'valor': 150, 'qtde': 1},
            ],
            'checklist': [
                {'id': 2, 'ordem': 2, 'item': 'Certidão de casamento', 'status': true},
                {'id': 3, 'ordem': 3, 'item': 'Reconhecimento de Firma', 'status': false},
                {'id': 4, 'ordem': 7, 'item': 'Cópia autenticada do RG', 'status': false}
            ],
            'participantes': [
                {'id': 2, 'nome': 'Clint Eastwood', 'cpf': '701.662.843-10'},
                {'id': 4, 'nome': 'Antonio Carlos', 'cpf': '603.415.982-00'},
                {'id': 6, 'nome': 'Paulo Coelho', 'cpf': '401.940.100-10'}
            ]
        };
        // $scope.os = {'cliente':{'nome':""}};

        $scope.pesquisarPF = function (p) {
            console.log(p);
            listarCliente(p, 'PF');
        }

        $scope.pesquisarPJ = function (p) {
            console.log(p);
            listarCliente(p, 'PJ');
        }

        $scope.addPF = function (pf) {
            $scope.os.cliente = pf;
            console.log(pf);
        }

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        /**
         * Funcao de alert para confirmar
         * @param obj
         */
        var confirmaDelete = function (obj) {
            SweetAlert.swal({
                    title: "Deseja apagar?",
                    text: "Você não poderar recuperar essa informação novamente!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim, apague!",
                    cancelButtonText: "Não, cancele!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var dados = {'session': true, 'metodo': 'deletar', 'data': obj, 'class': 'ordemdeservico'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if (response['data']) {
                                    if (response.data.result == false) {
                                        SweetAlert.swal("Ops!!!", response.data.msg, "error");
                                    } else {
                                        SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                                        listarOS();
                                    }

                                } else {
                                }
                            }, function errorCallback(response) {
                            });
                        //SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                    } else {
                        SweetAlert.swal("Cancelado", "Operação cancelado pelo usuário", "error");
                    }
                });
        };


        /**
         * Limpa os campos na tela
         */
        $scope.limparCampos = function () {
            delete $scope.ordemdeservico;
            //$scope.atualizacao = true;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarOS = function (obj) {
            var dados;

            if (obj.id == undefined) {
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'ordemdeservico'};
            } else {
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'ordemdeservico'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        delete $scope.ordemdeservico;
                        listarOS();
                    } else {
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarOS = function (obj) {
            $scope.ordemdeservico = obj;
        };

        $scope.deletarOS = function (obj) {

            confirmaDelete(obj);
        };

        var listarServico = function () {

            var dados = {'metodo': 'listar', 'data': null, 'class': 'servico'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        $scope.servicos = response['data'];
                    } else {
                    }
                }, function errorCallback(response) {
                });
        };

        var listarOS = function () {

            var dados = {'metodo': 'listar', 'data': null, 'class': 'ordemdeservico'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        $scope.ordemdeservicos = response['data'];

                    } else {
                    }
                }, function errorCallback(response) {
                });
        };

        var listarCliente = function (busca, tipo) {

            var dados = {
                'session': true,
                'metodo': 'buscarPessoa',
                'data': {'busca': busca, 'tipo': tipo},
                'class': 'grupopessoa'
            };

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        console.log(response['data']['data']);
                        $scope.grupoPF = response['data']['data'];
                        $scope.grupoPJ = response['data']['data'];
                    } else {
                        alert('vazio');
                    }
                }, function errorCallback(response) {
                });
        };

        listarOS();
        listarServico();


    });