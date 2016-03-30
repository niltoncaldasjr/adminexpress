angular.module('admin-express')
    .controller('pessoaGenericCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI, $timeout, $uibModal) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        $timeout(function() {document.getElementById('cep').focus();}, 1000);

        /*
            Cria model Pessoa
        */
        function createScopes () {
            $rootScope.gpes = {
                "pessoa":       {"tipo":""},
                "pessoapf":     {"sexo":"MASCULINO"},
                "pessoapj":     {"representantes":[]},
                "reppessoa":    {},
                "reppessoapf":  {"sexo":"MASCULINO"}
            };
        }
        createScopes();

        /*
            Consulta o tipo de pessoa na tebale Grupo a partir do final da url
        */
        function consultaTipoPessoaGrupo () {
            /* Pegando o final da url */
            var href = window.location.href; href = href.split('/'); href = href[href.length-1];

            /* Consulta tipos de pessoa */
            var dados = {'metodo': 'buscarPorDescricao', 'data': href, 'class': 'grupo'};

            /* Grupo Pessoa */
            $scope.grupo = href;

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    var tipo = response['data']['tipo'];
                    /* Variável que controla o que aparece no form */
                    $scope.tipopessoa = tipo;
                    /* Variável que diz o se é PJ ou PF */
                    if(response['data']['tipo'] === 'AMBOS') {$rootScope.gpes.pessoa.tipo = 'PF';}
                    else {$rootScope.gpes.pessoa.tipo = tipo;}
                }else{
                    alert('Ainda não existe este Grupo!');
                }
            }, function errorCallback(response) {
            });
        }

        consultaTipoPessoaGrupo();

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
            consultaTipoPessoaGrupo();
            document.getElementById('cep').focus();
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrar = function(objPessoa, objPF, objPJ, objCliente){
            
            console.log(objPessoa);
            if($scope.p === 'PF') { console.log(objPF); }
            else { console.log(objPJ); }
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

        $scope.editar = function(obj){
            // $scope.generic = obj;
        };

        $scope.deletar = function(obj){

            confirmaDelete(obj);
        };

        var listar = function(){

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

        // listarorgao();
        

        /*
            Adiciona Representante
        */
        $scope.addRepresentante = function () {
            var modalInstance = $uibModal.open({
                templateUrl: 'views/representantepj/cadRepresentantePJ.html',
                controller: representanteCtrl,
                size: 'lg'
            });
        }

        /*
            Ctrl Representante
        */
        function representanteCtrl ($scope, $uibModalInstance) {

            $scope.ok = function (objP, objPF) {
                objPF.pessoa = objP;
                $rootScope.gpes.pessoapj.representantes.push(objPF);
                console.log($rootScope.gpes.pessoapj);
                $uibModalInstance.close();
            };

            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };

            
        }

    });