angular.module('admin-express')
    .controller('certidaoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        $scope.certidoes = {};
        $scope.menus = {};
        $scope.permissoesShow = false;

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'certidao'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    if(response.data.result == false){
                                        SweetAlert.swal("Ops!!!", response.data.msg, "error");
                                    }else{
                                        SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                                        listarCertidao();
                                    }
                                }else{
                                }
                            }, function errorCallback(response) {
                            });
                        //SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                    } else {
                        SweetAlert.swal("Cancelado", "A informação foi mantida :)", "error");
                    }
                });
        };


        /**
         * Limpa os campos na tela
         */
        $scope.limparCampos = function(){
            delete $scope.certidao;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarCertidao = function(obj){
            //console.log($scope.permissoes);
            var dados;

            if(obj.id == undefined){
                var dados = {'session': true, 'metodo': 'cadastrar', 'data': obj, 'class': 'certidao'};
            }else{
                var dados = {'session': true, 'metodo': 'atualizar', 'data': obj, 'class': 'certidao'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        delete $scope.certidao;
                        listarCertidao();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarCertidao = function(obj){
            $scope.limparCampos();
            $scope.certidao = obj;
        };

        $scope.deletarCertidao = function(obj){

            confirmaDelete(obj);
        };

        var listarCertidao = function(){

            var dados = {'session':true, 'metodo': 'listar', 'data': null, 'class': 'certidao'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    $scope.certidoes = response['data'];
                }else{
                }
            }, function errorCallback(response) {
            });
        };

        listarCertidao();



    });