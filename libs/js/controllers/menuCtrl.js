angular.module('admin-express')

    .controller('header_menu', function ($scope, $rootScope, $location, $http, genericAPI, authenticationAPI) {

        $rootScope.trazer_perfil = function(){

            var dados = {'session': true ,'metodo': 'trazer_perfil', 'data': $rootScope.usuario, 'class': 'perfil'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                    $scope.nome = response['data']['pessoa']['nome'];
                    $scope.perfil = response['data']['perfil']['nome'];
                    $scope.pathfoto = 	response['data']['img'];
                    //$('.meu-perfil-img').attr('src', response['data']['img']);
                    } else {
                        //window.location.replace("index.php");
                    }
                }, function errorCallback(response) {
                });
        }

        $rootScope.trazer_menu = function(){

            var dados = {'session': true ,'metodo': 'listar', 'data': $rootScope.usuario, 'class': 'menu'};

            genericAPI.generic(dados)
                .then(function successCallback(response) {
                    if (response['data']) {
                        $rootScope.menus = response['data'];
                    } else {
                        //window.location.replace("index.php");
                    }
                }, function errorCallback(response) {
                });
        }

        if($rootScope.usuario){
            $rootScope.trazer_menu();
            $rootScope.trazer_perfil();
        }

        $scope.abrir = function (param) {

            if ($("." + param).hasClass('in')) {
                $('li').removeClass('active');
                $("." + param).removeClass('in');
            } else {
                $('ul').removeClass('in');
                $('li').removeClass('active');
                $("." + param).addClass('in');
                $('#' + param).addClass('active');
            }

        };
//
    });