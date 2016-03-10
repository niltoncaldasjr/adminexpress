angular.module('admin-express')
    .controller('perfilCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        //if (!$rootScope.usuario) {
        //    $location.path('/login');
        //}

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'perfil'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarPerfils();
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
            delete $scope.perfil;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarPerfil = function(obj){
            var dados;

            if(obj.id == undefined){
                var dados = {'session': false, 'metodo': 'cadastrar', 'data': obj, 'class': 'perfil'};
            }else{
                var dados = {'session': false, 'metodo': 'atualizar', 'data': obj, 'class': 'perfil'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        delete $scope.perfil;
                        listarPerfil();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarPerfil = function(obj){

            $scope.limparCampos();
            $scope.perfil = obj;
        };

        $scope.deletarPerfil = function(obj){

            confirmaDelete(obj);
        };

        var listarPerfil = function(){

            var dados = {'session':true, 'metodo': 'listar', 'data': null, 'class': 'perfil'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    $scope.perfils = response['data'];
                }else{
                }
            }, function errorCallback(response) {
            });
        };

        listarPerfil();



    });