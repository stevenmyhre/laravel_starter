'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('app', [
    'ui.router',
    'angular-growl',
    'globalErrors'
])
    .config(['$httpProvider', '$stateProvider', '$urlRouterProvider', '$logProvider', 'uiGmapGoogleMapApiProvider', function($httpProvider, $stateProvider, $urlRouterProvider, $logProvider, uiGmapGoogleMapApiProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

        $urlRouterProvider.otherwise("/");

        $logProvider.debugEnabled(true);
    }])
    .run(['$rootScope', '$state', '$stateParams', '$animate', function($rootScope, $state, $stateParams, $animate) {
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;
        $rootScope.loading = true;

        $rootScope.$on('$stateChangeStart',
            function (e, toState, toParams, fromState, fromParams) {
                $rootScope.loading = true;
            });

        $rootScope.$on('$stateChangeSuccess', function() {
            $rootScope.loading = false;
        });

        $rootScope.$on('$stateChangeError', function() {
            $rootScope.loading = false;
        });
    }]);
