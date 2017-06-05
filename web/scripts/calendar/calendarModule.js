'use strict';
var calendarModule = angular.module('app.calendar', [])
    .config(['$urlRouterProvider', '$stateProvider',
        function($urlRouterProvider, $stateProvider) {
    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('event', {
            url: '/event',
            templateUrl: 'scripts/calendar/views/index.php',
            controller: 'calendarController'
        })
        .state('event.create', {
            url: '/create/:date',
            templateUrl: 'scripts/calendar/views/create.php'
        })
        .state('event.view', {
            url: '/view/:eventId',
            templateUrl: 'scripts/calendar/views/view.php'
        })
        .state('event.update', {
            url: '/view/:eventId',
            templateUrl: 'scripts/calendar/views/update.php'
        })
}]);

