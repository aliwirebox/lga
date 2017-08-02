<form action="{{ route($path) }}" method="post">
    {{csrf_field()}}
    
    <div class="form-group">
        <label>Current Password (6 or more characters)*</label>
        <input type="password" class="form-control" name="currentpassword">
    </div>
    <div class="form-group">
        <label>New Password (6 or more characters)*</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label>Repeat Password (6 or more characters)*</label>
        <input type="password" class="form-control" name="password_confirmation">
    </div>
    <div class="form-group m-top-25">
        <button name="change-password-candidate" class="btn btn-primary btn-lg btn-block">Change Now</button>
    </div>
</form>
