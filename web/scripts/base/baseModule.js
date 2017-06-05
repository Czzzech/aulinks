'use strict';
var api = "http://perevozniy.000webhostapp.com/back/web/index.php?r=";

var app = angular.module('app', [
    'ui.router',
    'ui.bootstrap',
    'ui.calendar',
    'app.user',
    'app.calendar',
    'ngCookies',
    'angular-growl',
    'chieffancypants.loadingBar',
    'ngAnimate'
]);

app.config([
    '$urlRouterProvider',
    '$stateProvider',
    'growlProvider',
    'cfpLoadingBarProvider',
    function($urlRouterProvider, $stateProvider, growlProvider, cfpLoadingBarProvider) {

        cfpLoadingBarProvider.includeSpinner = true;

        growlProvider.globalReversedOrder(true);
        growlProvider.globalTimeToLive({success: 1500, error: 4000, warning: 3000, info: 4000});
        growlProvider.globalDisableCountDown(true);

        $urlRouterProvider.otherwise('/');

        $stateProvider
            .state('base', {
                url: '/',
                templateUrl: 'scripts/base/views/index.php'
            });
}])
    .run(function($rootScope, $state, userService, AUTH_EVENTS, notify){
        $rootScope.$on('$locationChangeStart', function(event, next, nextParams, fromState){
            var temp = next.split('/');
            var ctr = temp[temp.length - 2];
            var act = temp[temp.length - 1];
            if(act.length == '32' && ctr == 'register'){
                event.preventDefault();
                notify.info('Please, register!')
                $state.go('user.register', {inviteLink: act});
            }else {
                if (!userService.isValid()) {
                    if (act !== 'login' && act !== 'register') {
                        if (ctr !== 'user') {
                            event.preventDefault();
                            $state.go('user.login');
                        }
                    }
                } else {
                    if (ctr == 'user') {
                        if (act == 'login' || act == 'register') {
                            event.preventDefault();
                            $state.go('base');
                        }
                    }
                }
            }
        });
    });
