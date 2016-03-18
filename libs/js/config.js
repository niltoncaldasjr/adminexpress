/**
 * INSPINIA - Responsive Admin Theme
 *
 * Inspinia theme use AngularUI Router to manage routing and views
 * Each view are defined as state.
 * Initial there are written state for all view in theme.
 *
 */
function config($stateProvider, $urlRouterProvider, $ocLazyLoadProvider, IdleProvider, KeepaliveProvider) {

    // Configure Idle settings
    IdleProvider.idle(5); // in seconds
    IdleProvider.timeout(120); // in seconds

    $urlRouterProvider.otherwise("/home");

    $ocLazyLoadProvider.config({
        // Set to true if you want to see what and when is dynamically loaded
        debug: false
    });

    $stateProvider

        .state('login', {
            url: "/login",
            templateUrl: "views/login.html",
            controller: "authenticationCtrl",
            data: { pageTitle: 'Login', specialClass: 'gray-bg'},
        })
        .state('home', {
            url: '/home',
            templateUrl: "views/home.html",
            data: { pageTitle: 'Home' },
            controller: 'homeCtrl',
        })
        .state('auth', {
            abstract: true,
            url: "/auth",
            templateUrl: "views/common/content.html",
        })
        .state('auth.perfil', {
            url: '/perfil',
            templateUrl: "views/cadPerfil.html",
            controller: 'perfilCtrl',
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        }
                    ]);
                }
            }
        })
        .state('auth.usuario', {
            url: '/usuario',
            templateUrl: "views/cadUsuario.html",
            controller: 'usuarioCtrl',
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro', {
            abstract: true,
            url: "/cadastro",
            templateUrl: "views/common/content.html",
        })
        .state('cadastro.banco', {
            url: '/banco',
            templateUrl: "views/bancoTab.html",
            controller: 'bancoCtrl',
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.indicacoes', {
            url: '/indicacoes',
            templateUrl: "views/cadIndicacao.html",
            controller: 'indicacaoCtrl',
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.servico', {
            url: '/servico',
            templateUrl: "views/cadServico.html",
            controller: 'servicoCtrl',
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        }
                    ]);
                }
            }
        })
        .state('outra', {
            abstract: true,
            url: "/outra",
            templateUrl: "views/common/content.html",
        })
        .state('outra.teste', {
            url: "/teste",
            templateUrl: "views/teste.html",
            //resolve: {
            //    loadPlugin: function ($ocLazyLoad) {
            //        return $ocLazyLoad.load([
            //            {
            //
            //                serie: true,
            //                name: 'angular-flot',
            //                files: [ 'js/plugins/flot/jquery.flot.js', 'js/plugins/flot/jquery.flot.time.js', 'js/plugins/flot/jquery.flot.tooltip.min.js', 'js/plugins/flot/jquery.flot.spline.js', 'js/plugins/flot/jquery.flot.resize.js', 'js/plugins/flot/jquery.flot.pie.js', 'js/plugins/flot/curvedLines.js', 'js/plugins/flot/angular-flot.js', ]
            //            },
            //            {
            //                name: 'angles',
            //                files: ['js/plugins/chartJs/angles.js', 'js/plugins/chartJs/Chart.min.js']
            //            },
            //            {
            //                name: 'angular-peity',
            //                files: ['js/plugins/peity/jquery.peity.min.js', 'js/plugins/peity/angular-peity.js']
            //            }
            //        ]);
            //    }
            //}
        });



}
angular
    .module('admin-express')
    .config(config)
    .run(function($rootScope, $state) {
        $rootScope.$state = $state;
    });
