angular.module('admin-express')
    .controller('orgaoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        /*
            Cria model Pessoa
        */
        function createScopes () {
            $scope.p = 'pf';
            $scope.orgao = {};
            $scope.pessoa = {};
            $scope.pessoafisica = {"sexo":"MASCULINO"};
            $scope.pessoajuridica = {};
        }
        createScopes();

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'orgao'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarorgao();
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
            createScopes();
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarOrgao = function(objPessoa, objPF, objPJ, objCliente){
            
            console.log(objPessoa);
            if($scope.p === 'pf') { console.log(objPF); }
            else { console.log(objPJ); }
            console.log(objCliente);
            // var dados;
            
            // if(obj.id == undefined){
            //     var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'orgao'};
            // }else{
            //     var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'orgao'};
            // }

            // genericAPI.generic(dados)
            //     .then(function successCallback(response) {
            //         if(response['data']){
            //             $scope.limparCampos();
            //             listarorgao();
            //         }else{
            //         }
            //     }, function errorCallback(response) {
            //     });
        };

        $scope.editarorgao = function(obj){
            $scope.orgao = obj;
        };

        $scope.deletarorgao = function(obj){

            confirmaDelete(obj);
        };

        var listarorgao = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'orgao'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.orgaos = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        listarorgao();
        
    });