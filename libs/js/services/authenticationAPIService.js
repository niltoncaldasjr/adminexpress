angular.module('admin-express').service("authenticationAPI", function ($q, $location, $rootScope, $http) {
	
	function _genericAuthentication (data) {
		return $http({
			method: 'POST',
			url: "authenticator.php",
			data: {
				metodo: data.metodo,
				data: data.data, 
				class: data.class
			}
		});
	};

	// function _verificaSessao () {
	// 	return $http({
 //    		method: "POST",
 //    		url: "authenticator.php",
 //    		data: {metodo: "verificaSessao"}
 //    	})
 //    	then(function successCallback(response) {
 //                if (response['data']) {
 //                    console.log(response['data']);
 //                    listar(response['data']);
 //                } else {
 //                    //window.location.replace("index.php");
 //                }
 //            }, function errorCallback(response) {
	// }

	function _createSession (data, infinity) {
		//verifica se o cookie não foi marcado
		if(!infinity) infinity = false;
		//alimenta a variavel usuario com data;
		$rootScope.usuario = data;
		//criar a sessionStorage com oss dados do data
        sessionStorage["usuario"] = JSON.stringify(data);
        //cria obj Date com a data atual
        var now = new Date();
        //criar o obj do localStorage sessionMNAdmin
        var sessionMNAdmin = {
            "usuario": 	data, //alimenta os dados da session usuario
            "infinity": infinity, //passa true ou false para o cookie infinito
            "dataExp": 	new Date(now.getTime()+50000) //passa a data atual + 1 minuto para dataExp
        };
        //cria o local storage
        localStorage["sessionMNAdmin"] = JSON.stringify(sessionMNAdmin);
    }

	function _sessionCtrl () {
		
		/*
			Function generica para as várias operações abaixo
		*/
		function atualizaLocalStorage () {
			//converte json string para obj e armazena em session.
			var session = JSON.parse(localStorage['sessionMNAdmin']);
			//cria um novo obj de data atual
			var now = new Date();
			//atualiza o tempo da sessão, a hora atual +5 minutos
			session.dataExp = new Date(now.getTime()+50000);
			//atualiza a sessionStorage mynuvio cupom
			localStorage['sessionMNAdmin'] = JSON.stringify(session);
			//converte o obj em json string e salva em sessionStorage
			sessionStorage['usuario'] = JSON.stringify(session.usuario);
			//converte json string para obj e passa para o scopo usuario
			$rootScope.usuario = JSON.parse(sessionStorage['usuario']);
		}

		/*
			Verifica se existe sessionStore.usuario
		*/
		if(sessionStorage['usuario']) {
			
			atualizaLocalStorage();
			
		/*
			Caso não exista sessionStorage
		*/
		}else{
			/*
				Verifica se existe localStorage
			*/
			if(localStorage['sessionMNAdmin']) {
				//converte json string para obj e armazena em session.
				var session = JSON.parse(localStorage['sessionMNAdmin']);
				/*
					Verifica se a sessão tem conf infinita,
					sendo que o usuario está sempre logado
				*/
				if(session.infinity) {

					atualizaLocalStorage();

				}else{
					//cria um novo obj de data atual
					var now = new Date();
					//converte a string data da sessao em obj
					var dataSessao = new Date(session.dataExp);
					/*
						Compara se o tempo de sessão ainda está no prazo,
						convertendo as duas datas em milisegundos
					*/
					if(now.getTime() <= dataSessao.getTime()) {
						
						atualizaLocalStorage();
					
					}else{
					
						$rootScope.logout();
					
					}//fim if data.getTime
				}//fim if session infinity
			}//fim de if localStorage
		}//fim if sessionStorage

	}

	// logout global
    $rootScope.logout = function () {

    	if($rootScope.usuario) {
        	$http({
        		method: "POST",
        		url: "authenticator.php",
        		data: {metodo: "logout"}
        	}).then(function successCallback(response) {
	        	if(response.data) {

	        		window.sessionStorage.removeItem("usuario");
	        		window.localStorage.removeItem("sessionMNAdmin");
	        		$rootScope.usuario = "";
					//delete $rootScope.menus;
	        		$location.path("/login");
	        	}
	        });	
        };
    }

	return {
		genericAuthentication: _genericAuthentication,
		// verificaSessao : _verificaSessao,
		createSession: _createSession,
		sessionCtrl: _sessionCtrl
	};
});