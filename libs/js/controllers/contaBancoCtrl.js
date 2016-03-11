angular.module('admin-express')
    .controller('contaBancoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        $scope.atualizacao = true;

        if (!$rootScope.contaBanco) {
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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'contaBanco'};
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
            delete $scope.contaBanco;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarContaBanco = function(obj){
            obj.senha = MD5(obj.senha);

            var dados;

            if(obj.id == undefined){
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'contaBanco'};
            }else{
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'contaBanco'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        delete $scope.user;
                        listarContaBanco();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarContaBanco = function(obj){
            $scope.atualizacao = false;
            $scope.user = obj;
        };

        $scope.deletarContaBanco = function(obj){

            confirmaDelete(obj);
        };

        var listarBanco = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'perfil'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.perfils = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        var listarContaBanco = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'contaBanco'};

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