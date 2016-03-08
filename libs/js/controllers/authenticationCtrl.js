var authenticationCtrl = function ($location, $scope, $rootScope, authenticationAPI) {
	
	//Verifica Sessao e permissão de acesso
    if($rootScope.usuario) { $location.path("/home"); return false; }
    // if(!sessionStorage['usuario']) { $location.path("/login"); return false; }

    
	$scope.logar = function (obj) {
        obj.senha = MD5(obj.senha);
		var data = { "metodo": "logarCupom", "data": obj, "class": "authentication" };

		authenticationAPI.genericAuthentication(data)
		.then(function successCallback(response) {
            //se o sucesso === true
			if(response.data.success == true){
                //criamos a session
            	authenticationAPI.createSession(response.data.data, obj.infinity);
                //logion error é escondido
                $scope.loginerror = false;
                //redirecionamos para home
                //$rootScope.trazer_menu();
            	$location.path('/home');
            }else{
                //passamos a msg de erro pro scopo
                $scope.login.msgerror = response.data.msg;
                //ativamos o login error com true
            	$scope.loginerror = true;
            }
        }, function errorCallback(response) {
        	//error
		});	
	};

    $scope.infinityAlert = function () {
        alert("mah oi");
    }

	$scope.cadastrar = function (obj) {

        var data = {"usuario" : obj.usuario, "senha": MD5(obj.senha)};
        data = {"metodo": "cadastrarUsuarioCupom", "data": data, "class":"usuario"};
		
       authenticationAPI.genericAuthentication(data)
		.then(function successCallback(response) {
            //se haver sucesso no cadastro
            if(response.data.success == true){
                //criamos a session com cookie infinity false
            	authenticationAPI.createSession(response.data.data, false);
                //cadastro error escondido
                $scope.loginerror = false;
                //redirecionamos para a home
                $location.path('/home');
            }else{
                //mostramos cadastro error
            	$scope.cadastroerror = true;
                //passamos a msg de error para o scope
                $scope.cadastro.msgerror = response.data.msg;
            }
        }, function errorCallback(response) {
        
		});	
	}
};

angular
	.module("admin-express")
	.controller("authenticationCtrl", authenticationCtrl);