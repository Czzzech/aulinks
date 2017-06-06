'use strict';
calendarModule.service("calendarService", [
    '$http',
    '$location',
    '$state',
    'notify',
    function($http, $location, $state, notify) {

        function validTime(start, end){
            return parseInt(moment(start).format('x')) < parseInt(moment(end).format('x'));
        }

        return {
            
            getEvents: function () {
                return $http.get(api + 'event&expand=author0');
            },
            
            createEvent: function (event) {
                if(!validTime(event.start, event.end)){
                    notify.error('Start time must be earlier then end!');
                    return;
                }
                return $http.post(api + 'event/create', event);
            },
            
            getEvent: function (eventID) {
                var _event = $http.get(api + 'event/view&id=' + eventID + '&expand=author0')
                return _event;
            },
            
            updateEvent: function (event, isForm) {
                var _event = {
                    id: event.id,
                    title: event.title,
                    description: event.description,
                    start: function(){
                        if(event.start != null) {
                            if (isForm != 1) {
                                return event.start.format('x');
                            } else {
                                return event.start;
                            }
                        }
                    },
                    end: function(){
                        if(event.end != null) {
                            if (isForm != 1) {
                                return event.end.format('x');
                            } else {
                                return event.end;
                            }
                        }
                    }
                };
                return $http.post(api + 'event/update&id=' + _event.id, _event);
            },
            
            deleteEvent: function (event) {
                return $http.post(api + 'event/delete&id=' + event.id);
            }
        }
    }]);
