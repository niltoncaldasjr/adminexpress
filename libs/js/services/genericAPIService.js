angular.module('admin-nuvio').service("genericAPI", function ($http) {

    function _generic (data, scope) {
        return $http({
            method: 'POST',
            url: "communicator.php",
            data: {
                session: data.session,
                metodo: data.metodo,
                data: data.data,
                class: data.class
            }
        });
    };

    return {
        generic: _generic
    };
});