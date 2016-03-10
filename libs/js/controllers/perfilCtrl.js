angular.module('admin-nuvio')
    .controller('cadCategoriaCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'categoria'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarCategorias();
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
            delete $scope.categoria;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarCategoria = function(obj){
            var dados;

            if(obj.id == undefined){
                var dados = {'session': false, 'metodo': 'cadastrar', 'data': obj, 'class': 'categoria'};
            }else{
                var dados = {'session': false, 'metodo': 'atualizar', 'data': obj, 'class': 'categoria'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){

                        delete $scope.categoria;
                        listarCategorias();
                        //$scope.limparCampos();
                        //$scope.categoriaForm.$setPrestine();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarCategoria = function(obj){

            $scope.limparCampos();
            $scope.categoria = obj;
        };

        $scope.deletarCategoria = function(obj){

            confirmaDelete(obj);
        };

        var listarCategorias = function(){

            var dados = {'session':true, 'metodo': 'listar', 'data': null, 'class': 'categoria'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    $scope.categorias = response['data'];
                }else{
                }
            }, function errorCallback(response) {
            });
        };

        listarCategorias();



    });