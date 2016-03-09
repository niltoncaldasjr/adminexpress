angular.module('admin-nuvio')
    .controller('homeCtrl', function ($scope, $location, $rootScope) {

        if (!$rootScope.usuario) {
            $location.path('/login');
        }

    });