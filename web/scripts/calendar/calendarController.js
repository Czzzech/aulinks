'use strict';
calendarModule.controller('calendarController', [
    '$scope',
    '$location',
    'calendarService',
    'userService',
    'notify',
        function($scope,$location,calendarService,userService, notify) {
                $scope.events = [];
                $scope.eventsSources = [$scope.events];
                $scope.newEvent = {
                    title: '',
                    start: '',
                    end: '',
                    description: '',
                    author: userService.user().id,
                    status: 'new',
                    color: ''
                },
                $scope.createEvent = function(){
                    calendarService.createEvent($scope.newEvent);
                },

                $scope.updateEvent = function(event, isForm){
                    calendarService.updateEvent(event, isForm);
                },

                $scope.deleteEvent = function(event){
                    calendarService.deleteEvent(event);
                },

                calendarService.getEvents().then(function(response){
                    //console.log(response.data);
                    $scope.events.slice(0, $scope.events.length);
                    angular.forEach(response.data, function(_event){
                        $scope.events.push({
                            id: _event.id,
                            title: _event.title,
                            description: _event.description,
                            start: _event.start,
                            end: _event.end,
                            color: _event.color,
                            textColor: 'black',
                            editable: userService.canEdit(_event.author),
                            author: _event.author,
                            status: _event.status
                        });
                    });
                    $scope.SelectedEvent = null;
                    $scope.uiConfig = {
                        height: 550,
                        editable: true,
                        selectable: true,
                        selectHelper: true,
                        slotDuration: '00:15:00',
                        eventLimit: 3,
                        header: {
                            left: 'month, agendaDay',
                            center: 'title',
                            right: 'today, prev,next'
                        },
                        navLinks: true,
                        navLinkDayClick: true,
                        allDaySlot: false,
                        eventRender: function( event, element, view ){
                            if(view.name == 'month') {
                                element.css('height', '20px');
                                element.children('div').css('margin-top', '3px')
                                    .css('font-size', '12px')
                                    .attr('title', 'Status: ' + event.status);
                            }
                            if(userService.canEdit(event.author)){
                                $(element).css('font-weight', 'bold')
                                    .css('text-decoration', 'underline');
                            }
                            if(event.status == 'inprogress'){
                                for(var i = 0;i < 50;i++){
                                    $(element).fadeTo('slow', 0.4).fadeTo('slow', 1);
                                }
                            }else if(event.status == 'done'){
                                $(element).fadeTo('slow', 0.7)
                            }
                        },

                        //view event
                        eventClick: function(event, jsEvent, view){

                            calendarService.getEvent(event.id).then(function(response){
                                $scope.viewEvent = response.data;
                                $('#viewEvent').modal('toggle');
                            },
                            function(error){
                                notify.error(error.data);
                            });
                        },

                        eventMouseover: function(event, jsEvent, view){
                            $(this).css('border-color', 'black');
                        },

                        eventMouseout: function(event, jsEvent, view){
                            $(this).css('border-color', event.color);
                        },

                        //updateEvent on month Agenda
                        eventDrop: function(event, delta, revertFunc, jsEvent, ui, view){
                            calendarService.updateEvent(event);
                        },

                        //updateEvent on day Agenda
                        eventResize: function(event, delta, jsEvent, ui, view){
                            if(view.name !== 'month')
                                calendarService.updateEvent(event);
                        },

                        //create on month agenda
                        dayClick: function(date, jsEvent, view){
                            if(view.name == 'agendaDay'){
                                return;
                            }
                            var text = $('h4.modal-title').text();
                            $('h4.modal-title').text(text + ' on ' + moment(date).format("YYYY-MM-DD"));
                            $('input[name="newEvent.startTime"]').val(date.format("YYYY-MM-DD 00:00:00")).trigger('change');
                            $('input[name="newEvent.endTime"]').val(date.format("YYYY-MM-DD 23:59:59")).trigger('change');
                            $('#createEvent').modal('toggle');
                        },

                        //creating new event on dayAgenda
                        select: function(start, end, jsEvent, view){
                            if(view.name == 'month'){
                                return;
                            }
                            var text = $('h4.modal-title').text();
                            $('h4.modal-title').text(text + ' on ' + moment(start).format("YYYY-MM-DD"));
                            $('input[name="newEvent.startTime"]').val(start.format("YYYY-MM-DD HH:mm:ss")).trigger('change');
                            $('input[name="newEvent.endTime"]').val(end.format("YYYY-MM-DD HH:mm:ss")).trigger('change');
                            $('#createEvent').modal('toggle');
                        }
                    }
                });
        }]);
