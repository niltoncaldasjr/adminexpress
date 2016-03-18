angular.module('admin-express')
    .controller('statusProcessoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        var startScope = function () {
            $scope.statusprocesso = {
                "nome":"",
                "web":"SIM"
            };
        }

        startScope();

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
                    closeOnCancel: false },
                function (isConfirm) {
                    if (isConfirm) {
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'statusprocesso'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarStatusProcesso();
                                }else{
                                }
                            }, function errorCallback(response) {
                            });
                        SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                    } else {
                        SweetAlert.swal("Cancelado", "A informação foi mantida :)", "error");
                    }
                });
        };


        /**
         * Limpa os campos na tela
         */
        $scope.limparCampos = function(){
            $scope.atualizacao = true;
            delete $scope.statusprocesso;
            startScope();
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarStatusProcesso = function(obj){
            
            var dados;
            
            if(obj.id == undefined){
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'statusprocesso'};
            }else{
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'statusprocesso'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.limparCampos();
                        listarStatusProcesso();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarStatusProcesso = function(obj){
            $scope.statusprocesso = obj;
        };

        $scope.deletarStatusProcesso = function(obj){

            confirmaDelete(obj);
        };

        var listarStatusProcesso = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'statusprocesso'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.statusprocessos = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        listarStatusProcesso();
        
    });