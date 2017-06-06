<div class="modal fade" id="createEvent" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Put some info about new event</h4>
            </div>
            <div class="modal-body">

                <form id="createEventForm">
                    <div class="form-group">
                        <div class="input-group">
                            <label>Event Name</label>
                            <input ng-model='newEvent.title' placeholder="Place name of event" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea required="required" ng-model="newEvent.description" class="form-control" rows="5" placeholder="Please input your description!"></textarea>
                    </div>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker1'>
                            <label>StartTime</label>
                            <input required="required" style="cursor: pointer;" name="newEvent.startTime" ng-model="newEvent.start" type='text' class="form-control" placeholder="StartTime"/>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker2'>
                            <label>EndTime</label>
                            <input required="required" style="cursor: pointer;" name="newEvent.endTime" ng-model="newEvent.end" type='text' class="form-control" placeholder="End time"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='input-group'>
                            <label>Choose background color</label>
                            <input id='colorPicker' style="cursor: pointer;" name="color" ng-model="newEvent.color" type='text' class="form-control" placeholder="Choose color"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="createButton" class="btn btn-primary" ng-click="createEvent()" data-dismiss="modal">Create</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>