<div class="modal fade" id="viewEvent" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="view-modal-title">Event #{{viewEvent.id}} - {{viewEvent.title}}. Status - {{viewEvent.status}}</h4>
            </div>
            <div class="modal-body">
                {{viewEvent}}
                <h4>Author: {{viewEvent.author0.email}}</h4>
                <form id="viewEventForm">
                    <div ng-if="viewEvent.author == user.id || user.isAdmin" class="form-group">
                        <label>Description</label>
                        <textarea ng-model="viewEvent.description" class="form-control" rows="5"></textarea>
                    </div>
                    <div ng-if="viewEvent.author != user.id && !user.isAdmin" class="form-group">
                        <label>Description</label>
                        <textarea disabled ng-model="viewEvent.description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <div ng-if="viewEvent.author == user.id || user.isAdmin"  class='input-group date' id='viewdatetimepicker1'>
                            <label>StartTime</label>
                            <input name="viewEvent.startTime" style="cursor: pointer;" ng-model="viewEvent.start" type='text' class="form-control"/>
                        </div>
                        <div ng-if="viewEvent.author !== user.id && !user.isAdmin" class='input-group date'>
                            <label>StartTime</label>
                            <input disabled ng-model="viewEvent.start" type='text' class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div ng-if="viewEvent.author == user.id || user.isAdmin" class='input-group date' id='viewdatetimepicker2'>
                            <label>EndTime</label>
                            <input name="viewEvent.endTime" ng-model="viewEvent.end" style="cursor: pointer;" type='text' class="form-control"/>
                        </div>
                        <div ng-if="viewEvent.author !== user.id && !user.isAdmin" class='input-group date'>
                            <label>EndTime</label>
                            <input disabled  ng-model="viewEvent.end" type='text' class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div ng-if="viewEvent.author == user.id || user.isAdmin" class='input-group'>
                            <label>Background color</label>
                            <input id='colorPickerView' name="color" style="cursor: pointer; background-color: {{viewEvent.color}};" ng-model="viewEvent.color" type='text' class="form-control"/>
                        </div>
                        <div ng-if="viewEvent.author != user.id && !user.isAdmin" class='input-group'>
                            <label>Background color</label>
                            <input disabled style="background-color: {{viewEvent.color}};" ng-model="viewEvent.color" type='text' class="form-control"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button ng-if="viewEvent.author == user.id || user.isAdmin" type="button" id="deleteButton" class="btn btn-danger" ng-click="deleteEvent(viewEvent)"">Delete</button>
                <button ng-if="viewEvent.author == user.id || user.isAdmin" type="button" id="updateButton" class="btn btn-success" ng-click="updateEvent(viewEvent)">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {

    $('#viewEvent').on('hidden.bs.modal', function(){
        $('input#colorPickerView').val('').trigger('change');
        $('input[ng-model="viewEvent.title"]').val('').trigger('change');
        $('textarea[ng-model="viewEvent.description"]').val('').trigger('change');
    });

    var elView = document.querySelector('input#colorPickerView');
    //console.log(elView);
    var colorPickerView = new CP(elView);

    colorPickerView.on("change", function (color) {
        $(elView).val('#' + color).trigger('change');
        elView.style.backgroundColor = '#' + color;
    }, 'main-change');
    var colorsView = ['012', '123', '234', '345', '456', '567', '678', '789', '89a', '9ab'], boxView;

    for (var i = 0, lenView = colorsView.length; i < lenView; ++i) {
        boxView = document.createElement('span');
        boxView.className = 'color-picker-box';
        boxView.title = '#' + colorsView[i];
        boxView.style.backgroundColor = '#' + colorsView[i];
        boxView.addEventListener("click", function (e) {
            colorPickerView.trigger("change", [this.title.slice(1)], 'main-change');
            e.stopPropagation();
        }, false);
        colorPickerView.picker.firstChild.appendChild(boxView);
    }

    $('#viewdatetimepicker1').datetimepicker({
        format: 'Y.m.d H:i:00',
        lang: 'en',
        onChangeDateTime: function (dp, $input) {
            $('input[name="viewEvent.startTime"]').val($input.val()).trigger('change');
        }
    });
    $('#viewdatetimepicker2').datetimepicker({
        format: 'Y.m.d H:i:00',
        lang: 'en',
        onChangeDateTime: function (dp, $input) {
            $('input[name="viewEvent.endTime"]').val($input.val()).trigger('change');
        }
    });
});
</script>