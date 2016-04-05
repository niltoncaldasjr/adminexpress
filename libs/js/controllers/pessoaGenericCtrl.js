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
                "grupo"         : {},
                "grupopessoa"   : {},
                "pessoa"        : {"tipo":""},
                "pessoapf"      : {"sexo":"MASCULINO", "datanascimento":moment(), "dataemissaodoc":moment()},
                "pessoapj"      : {"representantes":[]},
                "reppessoa"     : {},
                "reppessoapf"   : {"sexo":"MASCULINO", "datanascimento":moment(), "dataemissaodoc":moment()}
            };
        }
        createScopes();


        /*
            Carrega Profissões
        */
        function carregaProfissoes () {
        /* Consulta tipos de pessoa */
            var dados = {'session': true, 'metodo': 'listar', 'data': null, 'class': 'profissao'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    $rootScope.profissoes = response['data'];
                    console.log(response['data']);
                }else{
                    alert('Ainda não existe este Grupo!');
                }
            }, function errorCallback(response) {
            });
        }

        carregaProfissoes();

        /*
            Consulta o tipo de pessoa na tebale Grupo a partir do final da url
        */
        function consultaTipoPessoaGrupo () {
            /* Pegando o final da url */
            var href = window.location.href; href = href.split('/'); href = href[href.length-1];

            /* Consulta tipos de pessoa */
            var dados = {'session': true, 'metodo': 'buscarPorDescricao', 'data': href, 'class': 'grupo'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    var tipo = response['data']['tipo'];
                    /* Variável que controla o que aparece no form */
                    $rootScope.gpes.grupo = response['data'];
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
        $scope.cadastrar = function(obj){
            // Caso seja um tipo PJ verificamos se há representantes
            if(obj.pessoa.tipo === 'PJ') {
                if(obj.pessoapj.representantes.length<=0) {
                    alert('Cadastre pelomenos 1 representante');
                    return false;
                }
            }

            var dados;
            
            if(obj.grupopessoa.id === undefined){
                var dados = {'session': true, 'metodo': 'cadastrar', 'data': obj, 'class': 'grupopessoa'};
            }else{
                var dados = {'session': true, 'metodo': 'atualizar', 'data': obj, 'class': 'grupopessoa'};
            }

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    console.log(response['data']);
                    // $scope.limparCampos();
                    // listarorgao();
                }else{
                }
            }, function errorCallback(response) {
            });
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
            Adiciona Representante Modal
        */
        $scope.addRepresentante = function () {
            var modalInstance = $uibModal.open({
                templateUrl: 'views/representantepj/cadRepresentantePJ.html',
                controller: representanteCtrl,
                size: 'lg',
                backdrop: 'static'
            });
        }

        /*
            Ctrl Representante Modal
        */
        function representanteCtrl ($scope, $uibModalInstance) {

            $scope.ok = function (objP, objPF) {
                objPF.datanascimento = objPF.datanascimento.format('YYYY-MM-DD');
                objPF.dataemissaodoc = objPF.dataemissaodoc.format('YYYY-MM-DD');
           
                // Adiciona obj pessoa ao atributo pessoa de PessoaFisica
                objPF.pessoa = objP;
                // Pega o scope representantes
                var reps = $rootScope.gpes.pessoapj.representantes;
                // verifica se é uma edição ou atuaçização
                if(reps.indexOf(objPF)>=0) { reps.splice(reps.indexOf(objPF),1, objPF);}
                else{reps.push(objPF);}
                // reinicia obj reppessoa
                $rootScope.gpes.reppessoa = {};
                // reinicia obj reppessoapf
                $rootScope.gpes.reppessoapf = {"sexo":"MASCULINO", "datanascimento":moment(), "dataemissaodoc":moment()};
                // fecha o modal
                $uibModalInstance.close();
            };

            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };
        }

        /*
            Deleta representante
        */
        $scope.deletaRep = function (obj) {
            var reps = $rootScope.gpes.pessoapj.representantes;
            reps.splice(reps.indexOf(obj),1);
        }

        /*
            Edita representante
        */
        $scope.editarRep = function (obj) {
            // Abre o form modal
            $scope.addRepresentante();
            obj.datanascimento = moment(obj.datanascimento);
            obj.dataemissaodoc = moment(obj.dataemissaodoc);
            $rootScope.gpes.reppessoa = obj.pessoa;
            $rootScope.gpes.reppessoapf = obj;
        }

    });