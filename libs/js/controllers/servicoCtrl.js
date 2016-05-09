angular.module('admin-express')
    .controller('servicoCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI) {

        $scope.checklists = {};
        $scope.checklist = {id:"",idservico:"",item:"",ordem:""};

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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'servico'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    listarServico();
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
            delete $scope.servico;
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrarServico = function(obj){
            
            var dados;
            
            if(obj.id == undefined){
                var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'servico'};
            }else{
                var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'servico'};
            }

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.limparCampos();
                        listarServico();
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        $scope.editarServico = function(obj){
            $scope.servico = obj;
        };

        $scope.deletarServico = function(obj){

            confirmaDelete(obj);
        };

        $scope.mostrarChecklist = function(obj){

            $scope.checklists = {};
            $scope.checklist.idservico = obj.id;
            listarChecklist(obj);
        };

        var listarServico = function(){

            var dados = {'metodo': 'listar', 'data': null, 'class': 'servico'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.servicos = response['data'];
                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        var listarChecklist = function(obj){

            var dados = {'metodo': 'listarporservico', 'data': obj, 'class': 'checklist'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if(response['data']){
                        $scope.checklists = response['data'];

                    }else{
                    }
                }, function errorCallback(response) {
                });
        };

        listarServico();

        $scope.cadastrarChecklist = function(obj){
            console.log(obj);
            var dados;

            if(obj.idservico == undefined || obj.idservico == ""){
                SweetAlert.swal("Erro!", "Você deve escolher um serviço", "error");
            }else {


                if (obj.id == undefined || obj.id == "") {
                    var dados = {'metodo': 'cadastrar', 'data': obj, 'class': 'checklist'};
                } else {
                    var dados = {'metodo': 'atualizar', 'data': obj, 'class': 'checklist'};
                }

                genericAPI.generic(dados)
                    .then(function successCallback(response) {
                        if (response['data']) {
                            delete $scope.checklist;
                            obj.id = obj.idservico;
                            $scope.checklist = {id: "", idservico: "", item: "", ordem: ""};
                            $scope.mostrarChecklist(obj);
                        } else {
                        }
                    }, function errorCallback(response) {
                    });
            }
        };

        $scope.deletarChecklist = function(obj){

            confirmaDeleteChk(obj);
        };

        var confirmaDeleteChk = function (obj) {
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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'checklist'};
                        genericAPI.generic(dados)
                            .then(function successCallback(response) {
                                if(response['data']){
                                    if(response.data.result == false){
                                        SweetAlert.swal("Ops!!!", response.data.msg, "error");
                                    }else{
                                        SweetAlert.swal("Deletado!", "Essa informação foi deletada.", "success");
                                        // listarChecklist();
                                        obj.id = obj.idservico;
                                        $scope.checklist = {id:"",idservico:"",item:"",ordem:""};
                                        $scope.mostrarChecklist(obj);
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
       
    });