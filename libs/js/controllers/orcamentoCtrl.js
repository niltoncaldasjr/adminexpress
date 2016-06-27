angular.module('admin-express')
    .controller('orcamentoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        var createOrcamento = function () {
            $scope.orcamento = {
                'id': '', 'data': '',
                'idcliente': {},
                'idservico': {},
                'status': 'OFF',
                'observacao': '',
                'itensdeorcamento': [],
                'desconto': '',
                'total': 0,
                'subtotal': 0,
                'datacadastro': moment(),
                'desconto': 0
            };
        }

        createOrcamento();

        $scope.procura = {};

        $scope.listaOrcamento = [];

        $scope.pegartotal = function () {

            if ($scope.orcamento.itensdeorcamento.length > 0) {
                var itens = $scope.orcamento.itensdeorcamento;
                var tot = 20;
                var qtos = itens.length;
                for (var i = 0, len = itens.length; i < len; i++) {
                    tot = tot + itens[i].parcial;
                }
                return tot;
            } else {
                return 0;
            }
        }

        $scope.added = false;
        $scope.escolhido = false;
        $scope.busca = "";

        $scope.pesquisaCliente = function (p) {
            listarCliente(p);
            $scope.escolhido = true;
        }
        $scope.addCliente = function (cliente) {
            console.log(cliente);
            $scope.orcamento.idcliente = cliente;
            $scope.escolhido = false;
            // $scope.busca = "";
        }

        $scope.addItem = function (item) {
            $scope.orcamento.itensdeorcamento.push({'id': 0, 'idservico': item, 'quantidade': 1});
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
                        var dados = {'session': true, 'metodo': 'deletar', 'data': obj.id, 'class': 'orcamento'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if (response['data']) {
                                    if (response.data.result == false) {
                                        SweetAlert.swal("Ops!!!", response.data.msg, "error");
                                    } else {
                                        SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                                        listarOrcamento();
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
            delete $scope.orcamento;
            createOrcamento();
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarOrcamento = function (obj) {
            var dados;
            if (obj.id == undefined || obj.id == "") {
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'orcamento'};
            } else {
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'orcamento'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        delete $scope.orcamento;
                        createOrcamento();
                        listarOrcamento();
                    } else {
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarOrcamento = function (obj) {
            console.log(obj);
            $scope.orcamento = obj;
            listarOrcamento();

        };

        $scope.deletarOrcamento = function (obj) {

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

        var listarOrcamento = function () {

            var dados = {'metodo': 'listartodos', 'data': null, 'class': 'orcamento'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        $scope.listaOrcamento = response['data'];

                    } else {
                    }
                }, function errorCallback(response) {
                });
        };

        var listarCliente = function (busca) {

            var dados = {
                'session': true,
                'metodo': 'listarclientes',
                'data': {'busca': busca},
                'class': 'ordemdeservico'
            };

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        console.log(response['data']);
                        $scope.clientes = response['data'];
                        // $scope.grupoPJ = response['data']['data'];
                    } else {
                        alert('vazio');
                    }
                }, function errorCallback(response) {
                });
        };


        listarOrcamento();
        listarServico();



    });