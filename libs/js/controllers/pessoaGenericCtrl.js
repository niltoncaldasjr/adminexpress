angular.module('admin-express')
    .controller('pessoaGenericCtrl', function ($scope, $rootScope, $http, $location, genericAPI, SweetAlert, authenticationAPI, $timeout, $interval, $uibModal) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        // Starta novo cad
        $scope.novoCad = false;

        scrollTop:0;

        // $timeout(function() {document.getElementById('cep').focus();}, 1000);

        /*
            Cria model Pessoa
        */
        function createScopes () {
            $rootScope.gpes = {
                "busca"          : "",
                "grupo"         : {"descricao":"","tipo":""},
                "grupopessoa"   : {"idgrupo":"","idpessoa":"","informacao":""},
                "pessoa"        : {"tipo":"","CEP":"","endereco":"","numero":"","complemento":"","bairro":"","telefone":"","fax":"","celular":"","email1":"","email2":"","site":""},
                "pessoapf"      : {"objpessoa":{}, "nome":"","cpf":"","nacionalidade":"","naturalidade":"", "datanascimento":moment(), "estadocivil":"", "nomeconjuge":"", "objprofissao":{}, "tipodoc":"", "numerodoc":"", "orgaodoc":"", "dataemissaodoc":moment(), "pai":"", "mae":"", "sexo":"MASCULINO"},
                "pessoapj"      : {"objpessoa":{},"razao":"", "cnpj":"", "nire":"", "inscestadual":"", "inscmunicipal":"", "representantes":[]},
                "reppessoa"     : {"tipo":"","CEP":"","endereco":"","numero":"","complemento":"","bairro":"","telefone":"","fax":"","celular":"","email1":"","email2":"","site":""},
                "reppessoapf"   : {"objpessoa":{}, "nome":"","cpf":"","nacionalidade":"","naturalidade":"", "datanascimento":moment(), "estadocivil":"", "nomeconjuge":"", "objprofissao":{}, "tipodoc":"", "numerodoc":"", "orgaodoc":"", "dataemissaodoc":moment(), "pai":"", "mae":"", "sexo":"MASCULINO"},
                "rep"           : {"representante":"SIM"},
                "repsdel"       : []
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
                }else{
                    SweetAlert.swal("Atenção", "Este Grupo ainda não existe!", "error");
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

                    listaGrupoPessoa(response['data']);

                }else{
                    alert('Ainda não existe este Grupo!');
                }
            }, function errorCallback(response) {
            });
        }

        consultaTipoPessoaGrupo();

        /*
            Consulta grupospessoa
        */
        function listaGrupoPessoa (obj) {
            /* Consulta tipos de pessoa */
            var dados = {'session': true, 'metodo': 'listarPorGrupo', 'data': obj, 'class': 'grupopessoa'};

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    $scope.grupoPF = response['data']['grupoPF'];
                    $scope.grupoPJ = response['data']['grupoPJ'];
                }else{
                }
            }, function errorCallback(response) {
            });
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
                        var dados = {'session':true, 'metodo': 'deletar', 'data': obj, 'class': 'grupopessoa'};
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
        $scope.cancelar = function(){
            $scope.novoCad = false;
            createScopes();
            consultaTipoPessoaGrupo();
        };

        /**
         * Limpa os campos na tela
         */
        $scope.novoCadastro = function(){
            $scope.novoCad = true;
            $timeout(
                function () {
                    createScopes();
                    consultaTipoPessoaGrupo();
                    document.getElementById('cep').focus();
                },
                500
            );
        };

        /**
         * Função de salvar NOVO ou ALTERAR
         * checa o obj.id se existe entao altera
         * @param obj
         */
        $scope.cadastrar = function(obj){
            // Caso seja um tipo PJ verificamos se há representantes
            

            //limpa caracteres da mascara
            if(obj.pessoa.cep) obj.pessoa.cep      = obj.pessoa.cep.replace(/[^0-9]+/g, "");
            if(obj.pessoa.telefone) obj.pessoa.telefone = obj.pessoa.telefone.replace(/[^0-9]+/g, "");
            if(obj.pessoa.fax) obj.pessoa.fax      = obj.pessoa.telefone.replace(/[^0-9]+/g, "");
            if(obj.pessoa.celular) obj.pessoa.celular  = obj.pessoa.celular.replace(/[^0-9]+/g, "");

            if(obj.pessoa.tipo === 'PF') {
                if(obj.pessoa.cpf) obj.pessoapf.cpf = obj.pessoapf.cpf.replace(/[^0-9]+/g, "");
                obj.pessoapf.datanascimento = obj.pessoapf.datanascimento.format('YYYY-MM-DD');
                obj.pessoapf.dataemissaodoc = obj.pessoapf.dataemissaodoc.format('YYYY-MM-DD');
            }else{
                if(obj.pessoa.cnpj) obj.pessoapj.cnpj = obj.pessoapj.cnpj.replace(/[^0-9]+/g, "");
                obj.pessoapj.representantes = convertDataRepresentante(obj.pessoapj.representantes);
            }

            console.log(obj); return false;

            var dados;
            
            if(obj.grupopessoa.id === undefined){
                var dados = {'session': true, 'metodo': 'cadastrar', 'data': obj, 'class': 'grupopessoa'};
            }else{
                var dados = {'session': true, 'metodo': 'atualizar', 'data': obj, 'class': 'grupopessoa'};
            }

            genericAPI.generic(dados)
            .then(function successCallback(response) {
                if(response['data']){
                    $scope.limparCampos();
                    SweetAlert.swal("Sucesso!", "Sucesso na operação!", "success");
                }else{
                }
            }, function errorCallback(response) {
            });
        };

        // Edita Generic
        $scope.editar = function(obj){
            $rootScope.gpes.grupopessoa = obj;
            $rootScope.gpes.pessoa = obj.pes.objpessoa;
            if(obj.pes.objpessoa.tipo === 'PJ') {
                $rootScope.gpes.pessoapj = obj.pes;
                $rootScope.gpes.pessoapj.representantes = obj.representantes;
            }else{
                obj.pes.datanascimento = moment(obj.pes.datanascimento);
                obj.pes.dataemissaodoc = moment(obj.pes.dataemissaodoc);
                $rootScope.gpes.pessoapf = obj.pes;
            }
            
        };

        $scope.deletar = function(obj){
            confirmaDelete(obj);
        };


        /*
            Buscar
        */
        var conta;

        $scope.buscar = function (obj, tipo) {
            $interval.cancel(conta);
            delete $scope.buscaResult;
            $scope.buscaerror = false;

            if(obj === undefined) return false;

            // obj = obj.replace(/[^0-9]+/g, "");
            // obj = obj.substring(0,14);
            // $rootScope.gpes.busca = obj;

            // console.log($rootScope.gpes.busca);
            
            conta = $interval(
                function() {
                    if(obj.length>=4 && obj!==undefined) { 
                        $interval.cancel(conta);
                        buscaPessoa(obj, tipo);
                    }         
                }, 300);

            function buscaPessoa (busca, tipo) {
                var dados = {'session': true, 'metodo': 'buscarPessoa', 'data': {'busca':busca,'tipo':tipo}, 'class': 'grupopessoa'};
                
                genericAPI.generic(dados)
                .then(function successCallback(response) {
                    var data = response['data'];
                    if(data.success === true){
                        var pessoas = data.data;
                        if(tipo === 'PJ') {
                            $scope.buscaResult = pessoas;
                            // $scope.buscaResult.nome = pessoa.razao;
                            for(var i in $scope.buscaResult) {
                                $scope.buscaResult[i].nome = $scope.buscaResult[i].razao;
                                $scope.buscaResult[i].cpf  = $scope.buscaResult[i].cnpj;
                            }
                        }else{
                            $scope.buscaResult = pessoas;
                            // $scope.buscaResult.nome = pessoa.nome;
                        }
                    }else{
                        $scope.buscaerror = true;
                         // SweetAlert.swal("Atenção", "Sua busca não retornou resutados!", "error");
                    }
                }, function errorCallback(response) {
                });
            }           
        }

        $scope.usarBusca = function (obj) {
            $rootScope.gpes.pessoa = obj.objpessoa;
            if(obj.objpessoa.tipo==='PJ') {
                $rootScope.gpes.pessoapj = obj;
                $rootScope.gpes.pessoapj.representantes = [];
            }else{
                obj.datanascimento = moment(obj.datanascimento);
                obj.dataemissaodoc = moment(obj.dataemissaodoc);
                $rootScope.gpes.pessoapf = obj;
            }
            delete $scope.buscaResult;
            delete $rootScope.gpes.busca;
        }

        $scope.cancelaBusca = function () {
            delete $scope.buscaResult;
            delete $rootScope.gpes.busca;
        }


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

        function convertDataRepresentante (reps) {
            if(reps) {
                console.log(reps);
                for(var i in reps) {
                    // tirando mascara cpf representante
                    reps[i].pf.cpf = reps[i].pf.cpf.replace(/[^0-9]+/g, "");

                    if(typeof(reps[i].pf.datanascimento) === 'object') {
                        reps[i].pf.datanascimento = reps[i].pf.datanascimento.format('YYYY-MM-DD');
                        reps[i].pf.dataemissaodoc = reps[i].pf.dataemissaodoc.format('YYYY-MM-DD');
                    }
                }
            }
            return reps;
        }

        /*===========================================================================
            Ctrl Representante Modal
        ============================================================================*/
        function representanteCtrl ($scope, $uibModalInstance) {

            $scope.ok = function (objP, objPF, objRep) {
                objPF.datanascimento = objPF.datanascimento.format('YYYY-MM-DD');
                objPF.dataemissaodoc = objPF.dataemissaodoc.format('YYYY-MM-DD');

                // Adiciona obj pessoa ao atributo pessoa de PessoaFisica
                objPF.objpessoa = objP;
                objRep.pf = objPF;
                // Adiciona obj representante a pessoa
                // Pega o scope representantes
                var reps = $rootScope.gpes.pessoapj.representantes;
                // verifica se é uma edição ou atuaçização
                if(reps.indexOf(objRep)>=0) { reps.splice(reps.indexOf(objRep),1, objRep);}
                else{reps.push(objRep);}

                // reinicia obj reppessoa
                $rootScope.gpes.reppessoa = {};
                // reinicia obj reppessoapf
                $rootScope.gpes.reppessoapf = {"objpessoa":{}, "nome":"","cpf":"","nacionalidade":"","naturalidade":"", "datanascimento":moment(), "estadocivil":"", "nomeconjuge":"", "objprofissao":{}, "tipodoc":"", "numerodoc":"", "orgaodoc":"", "dataemissaodoc":moment(), "pai":"", "mae":"", "sexo":"MASCULINO"},
                // reinicia o obj rep
                $rootScope.gpes.rep = {"representante":"SIM", "funcao":""};
                // fecha o modal
                $uibModalInstance.close();
            };

            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
                // reinicia obj reppessoa
                $rootScope.gpes.reppessoa = {};
                // reinicia obj reppessoapf
                $rootScope.gpes.reppessoapf = {"objpessoa":{}, "nome":"","cpf":"","nacionalidade":"","naturalidade":"", "datanascimento":moment(), "estadocivil":"", "nomeconjuge":"", "objprofissao":{}, "tipodoc":"", "numerodoc":"", "orgaodoc":"", "dataemissaodoc":moment(), "pai":"", "mae":"", "sexo":"MASCULINO"},
                // reinicia o obj rep
                $rootScope.gpes.rep = {"representante":"SIM", "funcao":""};
            };

            // Buscar Representante
            var conta;
            $scope.buscar = function (obj) {
                $interval.cancel(conta);
                delete $scope.buscaResult;
                $scope.buscaerror = false;

                obj = obj.substring(0,11);
                $scope.busca = obj;
                
                conta = $interval(
                    function() {
                        if(obj.length>=11 && obj!==undefined) { 
                            $interval.cancel(conta);
                            buscaPessoa(obj);
                        }         
                    }, 2000);

                function buscaPessoa (busca) {
                    var dados = {'session': true, 'metodo': 'buscarPessoa', 'data': {'busca':busca,'tipo':'PF'}, 'class': 'grupopessoa'};
                    
                    genericAPI.generic(dados)
                    .then(function successCallback(response) {
                        var data = response['data'];
                        if(data.success === true){
                            var pessoa = data.data;
                            if(pessoa.objpessoa.tipo==='PJ') {
                                $scope.buscaResult = pessoa;
                                $scope.buscaResult.nome = pessoa.razao;
                            }else{
                                $scope.buscaResult = pessoa;
                                $scope.buscaResult.nome = pessoa.nome;
                            }
                        }else{
                            $scope.buscaerror = true;
                             // SweetAlert.swal("Atenção", "Sua busca não retornou resutados!", "error");
                        }
                    }, function errorCallback(response) {
                    });
                }           
            }

            $scope.usarBusca = function (obj) {
                $rootScope.gpes.reppessoa = obj.objpessoa;
                if(obj.objpessoa.tipo==='PJ') {
                    $rootScope.gpes.reppessoapj = obj;
                }else{
                    obj.datanascimento = moment(obj.datanascimento);
                    obj.dataemissaodoc = moment(obj.dataemissaodoc);
                    $rootScope.gpes.reppessoapf = obj;
                }
                delete $scope.buscaResult;
                delete $scope.busca;
            }

            $scope.cancelaBusca = function () {
                delete $scope.buscaResult;
                delete $scope.busca;
            }
        }

        /*
            Deleta representante
        */
        $scope.deletaRep = function (obj) {
            $rootScope.gpes.repsdel.push(obj);
            var reps = $rootScope.gpes.pessoapj.representantes;
            reps.splice(reps.indexOf(obj),1);
        }

        /*
            Edita representante
        */
        $scope.editarRep = function (obj) {
            // Abre o form modal
            $scope.addRepresentante();
            obj.pf.datanascimento = moment(obj.pf.datanascimento);
            obj.pf.dataemissaodoc = moment(obj.pf.dataemissaodoc);
            // Obj pessoa
            $rootScope.gpes.reppessoa = obj.pf.objpessoa;
            // Obj rep
            $rootScope.gpes.rep = obj;
            // Obj pessoa fisica
            $rootScope.gpes.reppessoapf = obj.pf;
        }

    });