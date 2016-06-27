angular.module('admin-express')
    .controller('osImpressaoCtrl', function ($scope, $stateParams, $rootScope, genericAPI, authenticationAPI) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

        $scope.os = {
            'id': '', 
            'idcliente': {},
            'idservico': {},
            'status': 'OFF',
            'observacao': '',
            'itensdeservico': [],
            'checklists': [],
            'participantes': [],
            'andamentos': [],
            'desconto':'',
            'total':0,
            'subtotal':0,
            'datacadastro':"",
            'desconto':0
        };

        $scope.pegartotal = function () {
        
            if($scope.os.itensdeservico.length > 0){
                var itens = $scope.os.itensdeservico;
                var tot = 20;
                var qtos = itens.length;
                for (var i = 0, len = itens.length; i < len; i++) {
                    tot = tot + itens[i].parcial;
                }
                return tot;
            }else{
                return 0;
            }
        }

        var listarOS = function () {
        
            var dados = {'metodo': 'buscarporid', 'data': $stateParams.id, 'class': 'ordemdeservico'};
        
            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        $scope.os = response['data'];
                        console.log($scope.os);
        
                    } else {
                    }
                }, function errorCallback(response) {
                });
        };
        listarOS();




    });