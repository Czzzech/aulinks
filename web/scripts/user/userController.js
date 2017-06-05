'use strict';
userModule.controller('userController', [
    '$scope',
    'userService',
    '$stateParams',
    'AUTH_EVENTS',
    '$state',
    'notify',
    function($scope, userService, $stateParams, AUTH_EVENTS, $state, notify){

        $scope.userToLogin = {
            email: '',
            password: ''
        };

        $scope.invite = {
            email: '',
            subject: '',
            text: ''
        }

        $scope.user = userService.user();

        $scope.$on(AUTH_EVENTS.notAuthenticated, function(event){
            userService.logout();
            $state.go('user.login');
        });

        $scope.sendInvitation = function(){
            $scope.invite.sender = $scope.user.id;
            userService.sendInvite($scope.invite).then(function(response){
                notify.success(response);
            },
            function(error){
                notify.error(error);
            });
        },

        $scope.login = function(){
            userService.login($scope.userToLogin).then(function(response){
                notify.success('You are successfully logged in!');
                $state.go('event');
            });
        };

        $scope.logout = function () {
            userService.logout();
            notify.info('See you later!');
            $state.go('user.login');
        };

        $scope.register = function(){
            $scope.user.inviteToken = $state.params.inviteLink;
            userService.register($scope.user).then(function(response){
                notify.success('You are successfully registered! Please, login!');
                $state.go('user.login');
            }, function(error){
                notify.error(error);
            })
        };
}]);
