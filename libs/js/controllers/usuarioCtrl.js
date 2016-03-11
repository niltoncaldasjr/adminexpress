angular.module('admin-express')
    .controller('usuarioCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        $scope.atualizacao = true;

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
                                    if(response.data.result == false){
                                        SweetAlert.swal("Ops!!!", response.data.msg, "error");
                                    }else{
                                        SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                                        listarUsuario();
                                    }

                                }else{
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
        $scope.limparCampos = function(){
            delete $scope.user;
            $scope.atualizacao = true;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarUsuario = function(obj){
            if(obj.senha != undefined){
                obj.senha = MD5(obj.senha);
            }

            var dados;

            if(obj.id == undefined){
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'usuario'};
            }else{
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'usuario'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        delete $scope.user;
                        listarUsuario();
                        $scope.atualizacao = true;
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.resetarSenha = function (obj)
        {
            confirmaResetSenha(obj);
        }

        $scope.editarUsuario = function(obj){
            $scope.atualizacao = false;
            $scope.user = obj;
        };

        $scope.deletarUsuario = function(obj){

            confirmaDelete(obj);
        };

        var listarPerfil = function(){

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

        var confirmaResetSenha = function (obj) {
            SweetAlert.swal({
                    title: "Deseja realmente resetar a Senha do usuário?",
                    text: "Uma senha padrão será enviada ao usuário!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim, reset!",
                    cancelButtonText: "Não, cancele!",
                    closeOnConfirm: false,
                    closeOnCancel: false },
                function (isConfirm) {
                    if (isConfirm) {
                        var dados = {'metodo': 'resetsenha', 'data': obj, 'class': 'usuario'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarUsuario();
                                }else{
                                }
                            }, function errorCallback(response) {
                            });
                        SweetAlert.swal("Resetado!", "O usuário será notificado.", "success");
                    } else {
                        SweetAlert.swal("Cancelado", "A informação foi mantida :)", "error");
                    }
                });
        };

        listarUsuario();
        listarPerfil();



    });