angular.module('admin-express')
    .controller('bancoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'banco'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarBanco();
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
            delete $scope.banco;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarBanco = function(obj){
            var dados;

            if(obj.id === undefined){
                var dados = {'session': false, 'metodo': 'cadastrar', 'data': obj, 'class': 'banco'};
            }else{
                var dados = {'session': false, 'metodo': 'atualizar', 'data': obj, 'class': 'banco'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        delete $scope.banco;
                        listarBanco();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarBanco = function(obj){

            $scope.limparCampos();
            $scope.banco = obj;
        };

        $scope.deletarBanco = function(obj){

            confirmaDelete(obj);
        };

        var listarBanco = function(){
        	
        	var dados = {'session':true, 'metodo': 'listar', 'data': null, 'class': 'banco'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                	$scope.bancos = response['data'];
                }else{
                }
            }, function errorCallback(response) {
            });
        };

        listarBanco();



    });