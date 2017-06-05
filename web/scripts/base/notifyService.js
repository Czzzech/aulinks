'use strict';
app.service('notify', [
    'growl',
    function(growl){
        return {
            warning: function(message){
                growl.warning(message, {title: 'Warning!'});
            },

            success: function(message){
                growl.success(message, {title: 'Success!'});
            },

            error: function(message){
                growl.error(message, {title: 'Error!'});
            },

            info: function(message){
                growl.info(message, {title: 'Info!'});
            }
        }
    }]);