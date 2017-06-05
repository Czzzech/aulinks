<form id="loginForm">
    <h2>Please Login</h2>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input required ng-model='userToLogin.email' type="email" class="form-control" placeholder="Place your Email">
    </div>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input required ng-model='userToLogin.password' type="password" class="form-control" placeholder="Place your password">
    </div>
    <br>
    <button id="loginButton" type="submit" class="btn btn-primary" ng-click="login()">Login</button>
</form>