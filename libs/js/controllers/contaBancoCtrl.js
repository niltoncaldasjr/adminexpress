angular.module('admin-express')
    .controller('contaBancoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

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
                    closeOnCancel: false },
                function (isConfirm) {
                    if (isConfirm) {
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'contabanco'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarContaBanco();
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
            delete $scope.contabanco;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarContaBanco = function(obj){
            
            var dados;
            
            if(obj.id == undefined){
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'contabanco'};
            }else{
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'contabanco'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.limparCampos();
                        listarContaBanco();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarContaBanco = function(obj){
            $scope.contabanco = obj;
        };

        $scope.deletarContaBanco = function(obj){

            confirmaDelete(obj);
        };

        var listarBanco = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'banco'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.bancos = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        var listarContaBanco = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'contabanco'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.contaBancos = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        listarContaBanco();
        listarBanco();



    });