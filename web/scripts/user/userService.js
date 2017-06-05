'use strict';
userModule.service('userService', [
    '$http',
    '$location',
    '$state',
    '$q',
    '$cookies',
    function($http, $location, $state, $q, $cookies){
        var tokenKey = 'aulinksToken';//in production it must be more safe :)
        var isValid = false;
        var authToken;
        var user = {
            name: '',
            id: '',
            email: '',
            isValid: false,
            isAdmin: false
        };

        function loadUserPermissions(){
            var _user = $cookies.get(tokenKey);
            if(_user){
                usePermissions(JSON.parse(_user));
            }
        }

        function setUserPermissions(_user){
            usePermissions(_user);
            $cookies.put(tokenKey, JSON.stringify(_user));
        }

        function usePermissions(_user){
            user.name = _user.name;
            user.id = _user.id;
            user.email = _user.email;
            user.isValid = true;
            user.token = _user.authKey;
            isValid = true;
            if(_user.isAdmin == 1)
                user.isAdmin = true;
            authToken = _user.authKey;
        }

        function deleteUserPermissions(){
            authToken = undefined;
            isValid = false;
            user.name = '';
            user.id = '';
            user.email = '';
            user.isValid = false;
            user.isAdmin = false;
            user.token = '';
            $cookies.remove(tokenKey);
        }

        loadUserPermissions();

        return {

            canEdit: function(id){
                return ((id == user.id) || user.isAdmin)
            },

            login: function(user){
                return $q(function(resolve, reject){
                    $http.post(api + '/user/login', user).then(function(result){
                        if(result.data.content){
                            setUserPermissions(result.data.content);
                            resolve(result.data.code);
                        }else{
                            reject(result.data.error);
                        }
                    });
                });
            },

            sendInvite: function(invite){
                return $q(function(resolve, reject){
                    $http.post(api + '/user/invite', invite).then(function(response){
                        if(response.data.code == 0){
                            resolve(response.data.content);
                        }else{
                            reject(response.data.error);
                        }
                    });
                });
            },

            register: function(user, inviteToken){
                return $q(function(resolve, reject){
                    $http.post(api + '/user/register', {user: user, token: inviteToken}).then(function(response){
                        if(response.data.code == 0){
                            resolve(response.data.content);
                        }else{
                            reject(response.data.error);
                        }
                    });
                });
            },

            logout: function(){
                deleteUserPermissions();
            },

            isValid : function(){return isValid;},

            user : function(){return user;}
        }
}])
    .factory('userInterceptor', ['$rootScope','$q','AUTH_EVENTS',
        function($rootScope, $q, AUTH_EVENTS){
            return {
                responseError: function(response){
                    $rootScope.$broadcast({
                        401: AUTH_EVENTS.notAuthenticated
                    }[response.status], response);
                    return $q.reject(response);
                }
            }
    }]);
