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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
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
        .state('cadastro.statusprocesso', {
            url: '/statusprocesso',
            templateUrl: "views/cadStatusProcesso.html",
            controller: 'statusProcessoCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.certidoes', {
            url: '/certidoes',
            templateUrl: "views/cadCertidao.html",
            controller: 'certidaoCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.honorario', {
            url: '/honorario',
            templateUrl: "views/cadHonorario.html",
            controller: 'honorarioCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.checklist', {
            url: '/checklist',
            templateUrl: "views/cadChecklist.html",
            controller: 'checklistCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        }
                    ]);
                }
            }
        })
        .state('admin', {
            abstract: true,
            url: "/admin",
            templateUrl: "views/common/content.html",
        })
        .state('admin.cliente', {
            url: '/cliente',
            templateUrl: "views/pessoa/cadPessoaGeneric.html",
            controller: 'pessoaGenericCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css','libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.ordemdeservico', {
            url: '/ordemdeservico',
            templateUrl: "views/ordemDeServico.html",
            controller: 'ordemDeServicoCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.orcamento', {
            url: '/orcamento',
            templateUrl: "views/orcamento.html",
            controller: 'orcamentoCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.corretores', {
            url: '/corretores',
            templateUrl: "views/pessoa/cadPessoaGeneric.html",
            controller: 'pessoaGenericCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css','libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);
                }
            }
        })
        
        .state('cadastro.cartorio', {
            url: '/cartorio',
            templateUrl: "views/pessoa/cadPessoaGeneric.html",
            controller: 'pessoaGenericCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css','libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);
                }
            }
        })
        .state('cadastro.orgaos', {
            url: '/orgaos',
            templateUrl: "views/pessoa/cadPessoaGeneric.html",
            controller: 'pessoaGenericCtrl',
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
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css','libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css','libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);
                }
            }
        })
        .state('impressao', {
            abstract: true,
            url: "/impressao",
            templateUrl: "views/common/content.html",
        })
        .state('impressao.os', {
            url: "/os/:id",
            templateUrl: "views/osimpressao.html",
            controller: 'osImpressaoCtrl',
            resolve: {
               loadPlugin: function ($ocLazyLoad) {
                   return $ocLazyLoad.load([

                   ]);
               }
            }
        });



}
angular
    .module('admin-express')
    .config(config)
    .run(function($rootScope, $state) {
        $rootScope.$state = $state;
    });
