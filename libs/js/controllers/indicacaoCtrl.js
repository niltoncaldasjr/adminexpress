angular.module('admin-express')
    .controller('indicacaoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'indicacao'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarIndicacao();
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
            delete $scope.indicacao;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarIndicacao = function(obj){
            
            var dados;
            
            if(obj.id == undefined){
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'indicacao'};
            }else{
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'indicacao'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.limparCampos();
                        listarIndicacao();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarIndicacao = function(obj){
            $scope.indicacao = obj;
        };

        $scope.deletarIndicacao = function(obj){

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

        var listarIndicacao = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'indicacao'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.indicacoes = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        listarIndicacao();
        // listarBanco();



    });