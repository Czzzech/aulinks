'use strict';
calendarModule.service("calendarService", [
    '$http',
    '$location',
    '$state',
    'notify',
    function($http, $location, $state, notify) {
        return {
            
            getEvents: function () {
                return $http.get(api + 'event&expand=author0');
            },
            
            createEvent: function (event) {
                if(moment(event.start) < moment(event.end)){
                    notify.error('Start & end time are wrong!');
                    return;
                }
                return $http.post(api + 'event/create', event).then(function(response) {
                    notify.success('Success!');
                    $('div#calendar').fullCalendar('renderEvent', response.data);
                },
                function (error) {
                    notify.error(error);
                });
            },
            
            getEvent: function (eventID) {
                var _event = $http.get(api + 'event/view&id=' + eventID + '&expand=author0')
                return _event;
            },
            
            updateEvent: function (event, isForm) {
                var start, end;
                if(isForm != 1) {
                    start = event.start.format("YYYY-MM-DD HH:mm:ss");
                    end = event.end.format("YYYY-MM-DD HH:mm:ss");
                }else{
                    start = event.start;
                    end = event.end;
                }
                var _event = {
                    id: event.id,
                    title: event.title,
                    description: event.description,
                    start: start,
                    end: end
                };
                return $http.post(api + 'event/update&id=' + _event.id, _event).then(function(response) {
                    if(isForm == 1) {
                        console.log(response.data);
                        $('div#calendar').fullCalendar('updateEvent', response.data);
                    }
                    notify.success('Success!');
                    },
                    function (error) {
                        console.log(error);
                        notify.error(error);
                    });
            },
            
            deleteEvent: function (event) {
                return $http.post(api + 'event/delete&id=' + event.id).then(function(response){
                    console.log(event);
                    $('div#calendar').fullCalendar('removeEvent', function(event){
                        return true;
                    });
                    notify.warning('Deleted!');
                },
                function(error){
                    notify.error(error);
                });
            }
        }
    }]);
