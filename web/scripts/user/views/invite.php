<form id="loginForm">
    <input ng-model='user.email' class="form-control hidden">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input ng-model='invite.email' placeholder="Place email to invite" type="email" class="form-control">
    </div>
    <div class="form-group">
        <label>Subject:</label>
        <input ng-model="invite.subject" name="subject" class="form-control" rows="5">
    </div>
    <div class="form-group">
        <label>Text Message</label>
        <textarea ng-model="invite.text" class="form-control" rows="5" placeholder="Please input your message!"></textarea>
    </div>
    <br>
    <button id="inviteButton" class="btn btn-primary" ng-click="sendInvitation()">Send Invitation</button>
</form>
