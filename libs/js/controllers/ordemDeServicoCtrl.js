angular.module('admin-express')
    .controller('ordemDeServicoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        $scope.os = {
            'id': '', 'data': '',
            'cliente': {'id': '', 'nome': ''},
            'servico': {'id': '', 'nome': '', 'valor': ''},
            'observacao': '',
            'itensdeservico': [],
            'checklists': [],
            'participantes': []
        };

        $scope.added = false;
        $scope.escolhido = false;
        $scope.busca = "";

        $scope.pesquisaCliente = function (p) {
            listarCliente(p);
            $scope.escolhido = true;
        }

        $scope.pesquisaParticipante = function (p) {
            listarCliente(p);
            $scope.added = true;
        }

        $scope.addParticipante = function (pes) {
            console.log(pes);
            $scope.os.participantes.push(pes);
            $scope.added = false;
            $scope.busca = "";
        }

        $scope.addCliente = function (cliente) {
            $scope.os.cliente = cliente;
            $scope.escolhido = false;
            // $scope.busca = "";
        }

        $scope.addItem= function (item) {
            var qtde = {qtde: 1};
            item.qtde = 1;
            $scope.os.itensdeservico.push(item);
        }

        $scope.escolher = function (serv) {
            listarChecklist(serv);
        }

        $scope.finalizar = function (os) {
            console.log(os);

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

        var listarChecklist = function(obj){

            var dados = {'metodo': 'listarporservico', 'data': obj, 'class': 'checklist'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.os.checklists = response['data'];

                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        listarOS();
        listarServico();


    });