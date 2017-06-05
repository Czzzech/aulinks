<!DOCTYPE html>
<html ng-app="app">
<head>
  	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-theme.min.css" />
  	<link rel="stylesheet" href="assets/ui-calendar/fullcalendar.css" />
  	<link rel="stylesheet" href="assets/jquery/datetimepicker/jquery.datetimepicker.min.css" />
  	<link rel="stylesheet" href="assets/jquery/colorpicker/colorpicker.css" />
  	<link rel="stylesheet" href="assets/angular/growl/angular-growl.min.css" />
  	<link rel="stylesheet" href="assets/angular/loading/loading-bar.min.css" />
  	<link rel="stylesheet" href="css/main.css" />
  	<script src="assets/ui-calendar/moment.js"></script>
  	<script src="assets/jquery/jquery-3.2.1.min.js"></script>
  	<script src="assets/jquery/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/jquery/colorpicker/colorpicker.js"></script>
    <script src="assets/jquery/validator/validator.js"></script>
  	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/angular/angular.min.js"></script>
    <script src="assets/angular/angular-ui-router.min.js"></script>
    <script src="assets/angular/angular-cookies.min.js"></script>
    <script src="assets/angular/angular-animate.min.js"></script>
  	<script src="assets/ui-calendar/calendar.js"></script>
  	<script src="assets/ui-calendar/fullcalendar.js"></script>
  	<script src="assets/angular/ui-bootstrap-tpls-2.5.0.min.js"></script>
  	<script src="assets/angular/growl/angular-growl.min.js"></script>
  	<script src="assets/angular/loading/loading-bar.min.js"></script>
    <script src="scripts/calendar/calendarModule.js"></script>
    <script src="scripts/user/userModule.js"></script>
    <script src="scripts/base/baseModule.js"></script>
    <script src="scripts/base/baseService.js"></script>
    <script src="scripts/calendar/calendarService.js"></script>
    <script src="scripts/user/userService.js"></script>
    <script src="scripts/base/baseController.js"></script>
    <script src="scripts/calendar/calendarController.js"></script>
    <script src="scripts/user/userController.js"></script>
    <script src="scripts/base/notifyService.js"></script>

</head>
<body ng-controller="baseController" class="md-padding" id="popupContainer" ng-cloak>
<div growl limit-messages="3"></div>
    <div ng-controller="userController">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#!/">Aulinks</a>
                </div>
                <ul class="nav navbar-nav">
                    <li ng-if="user.isValid"><a href="#!/event">Calendar</a></li>
                    <li ng-if="user.isAdmin"><a href="#!/user/invite">Invite user</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li ng-if="user.isValid"><a href="#" ng-click="logout()">Logout({{user.email}})</a></li>
                </ul>
            </div>
        </nav>


    <!-- Begin page content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8" align="center">
                    <ui-view></ui-view>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container" align="center">
            <p class="text-muted">Aulinks test</p>
        </div>
    </footer>

</body>

</html>
