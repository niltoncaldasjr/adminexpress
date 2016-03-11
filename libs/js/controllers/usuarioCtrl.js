angular.module('admin-express')
    .controller('usuarioCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {



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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'usuario'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarUsuario();
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
            delete $scope.usuario;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarUsuario = function(obj){
            var dados;

            if(obj.id == undefined){
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'usuario'};
            }else{
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'usuario'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        delete $scope.usuario;
                        listarUsuario();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarUsuario = function(obj){

            $scope.limparCampos();
            $scope.usuario = obj;
        };

        $scope.deletarUsuario = function(obj){

            confirmaDelete(obj);
        };

        var listarUsuario = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'usuario'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    $scope.usuarios = response['data'];
                }else{
                }
            }, function errorCallback(response) {
            });
        };

        listarUsuario();



    });