<form id="loginForm">
    <h2>Registration Form</h2>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input required ng-model='user.email' type="email" class="form-control" placeholder="Place your Email">
    </div>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input required ng-model='user.password' type="password" class="form-control" placeholder="Place your password">
    </div>
    <br>
    <button id="registerButton" class="btn btn-primary" ng-click="register()">Register</button>
</form>