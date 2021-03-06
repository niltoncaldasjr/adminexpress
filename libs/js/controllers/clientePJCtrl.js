angular.module('admin-express')
angular.module('admin-express')
    .controller('clientePJCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        /*
            Cria model Pessoa
        */
        $scope.pessoa = {};
        $scope.pessoajuridica = {};
        $scope.cliente = {};

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'clientepj'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarclientePF();
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
            delete $scope.clientepj;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarclientePF = function(objPessoa, objPJ, objCliente){
            
            console.log(objPessoa);
            console.log(objPJ);
            console.log(objCliente);
            // var dados;
            
            // if(obj.id == undefined){
            //     var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'clientepj'};
            // }else{
            //     var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'clientepj'};
            // }

            // genericAPI.generic(dados)
            //     .then(function successCallback(response) {
            //         if(response['data']){
            //             $scope.limparCampos();
            //             listarclientePF();
            //         }else{
            //         }
            //     }, function errorCallback(response) {
            //     });
        };

        $scope.editarclientePF = function(obj){
            $scope.clientepj = obj;
        };

        $scope.deletarclientePF = function(obj){

            confirmaDelete(obj);
        };

        var listarclientePF = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'clientepj'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.clientepjs = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        listarclientePF();
        
    });