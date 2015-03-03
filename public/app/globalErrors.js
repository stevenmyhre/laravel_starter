'use strict';

angular.module("globalErrors", ['angular-growl', 'ngAnimate']).factory("myHttpInterceptor", function($q, $log, $location, growl, $rootScope) {
    var numLoading = 0;
    return {
        request: function(config) {
            numLoading++;
            $rootScope.loading = true;
            return config || $q.when(config)
        },
        response: function(response) {
            numLoading--;
            $rootScope.loading = numLoading > 0;
            return response || $q.when(response);
        },
        responseError: function(rejection) {
            //$log.debug("error with status " + rejection.status + " and data: " + rejection.data['message']);
            numLoading--;
            $rootScope.loading = numLoading > 0;
            switch (rejection.status) {
                case 401:
                    document.location = "/auth/login";
                    growl.error("You are not logged in!");
                    break;
                case 403:
                    growl.error("You don't have the right to do this");
                    break;
                case 0:
                    growl.error("No connection, internet is down?");
                    break;
                default:
                    if (rejection.data && rejection.data['message'])
                        growl.error("" + rejection.data['message']);
                    else
                        growl.error("There was an unknown error processing your request");
            }
            return $q.reject(rejection);
        }
    };
}).config(function($provide, $httpProvider) {
    return $httpProvider.interceptors.push('myHttpInterceptor');
});