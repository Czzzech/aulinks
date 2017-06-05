<div id="calendar" ui-calendar="uiConfig" ng-model="eventsSources" calendar="myCalendar"></div>
<?php include('view.php');?>
<?php include('create.php');?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#createEvent').on('hidden.bs.modal', function(){
            $('h4.modal-title').text('Put some info about new event');
            $('input#colorPicker').val('').trigger('change');
            $('input[ng-model="newEvent.title"]').val('').trigger('change');
            $('textarea[ng-model="newEvent.description"]').val('').trigger('change');
        });

        $('#datetimepicker1').datetimepicker({
            format:'Y.m.d H:i:00',
            lang:'en',
            onChangeDateTime: function(dp,$input){
                $('input[name="newEvent.startTime"]').val($input.val()).trigger('change');
            }
        });
        $('#datetimepicker2').datetimepicker({
            format:'Y.m.d H:i:00',
            lang:'en',
            onChangeDateTime: function(dp,$input){
                $('input[name="newEvent.endTime"]').val($input.val()).trigger('change');
            }
        });

        var el = document.querySelector('input#colorPicker');
        var colorPicker = new CP(el);

        colorPicker.on("change", function(color) {
            $(el).val('#' + color).trigger('change');
            el.style.backgroundColor = '#' + color;
        }, 'main-change');

        var colors = ['012', '123', '234', '345', '456', '567', '678', '789', '89a', '9ab'], box;

        for (var i = 0, len = colors.length; i < len; ++i) {
            box = document.createElement('span');
            box.className = 'color-picker-box';
            box.title = '#' + colors[i];
            box.style.backgroundColor = '#' + colors[i];
            box.addEventListener("click", function(e) {
                colorPicker.trigger("change", [this.title.slice(1)], 'main-change');
                e.stopPropagation();
            }, false);
            colorPicker.picker.firstChild.appendChild(box);
        }
    });


</script>
