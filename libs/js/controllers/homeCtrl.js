angular.module('admin-express')
    .controller('homeCtrl', function ($scope, $location, $rootScope) {


        if (!$rootScope.usuario) {
            $location.path('/login');
        }

    });