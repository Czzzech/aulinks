'use strict';
var userModule = angular.module('app.user', [])
    .constant('AUTH_EVENTS', {
        notAuthenticated: 'auth-not-authenticated'
    })
    .config(['$urlRouterProvider', '$stateProvider','$httpProvider',
        function($urlRouterProvider, $stateProvider, $httpProvider) {

    $httpProvider.interceptors.push('userInterceptor');

    $stateProvider
        .state('user', {
            url: '/user',
            abstract: true,
            controller: 'userController'
        })
        .state('user.invite', {
            url: '/invite',
            templateUrl: 'scripts/user/views/invite.php'
        })
        .state('user.login', {
            url: '/login',
            templateUrl: 'scripts/user/views/login.php'
        })
        .state('user.register', {
            url: '/register',
            params: {
                inviteLink: null
            },
            templateUrl: 'scripts/user/views/register.php'
        })
}]);