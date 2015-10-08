<h3>2. Email notifications</h3>
<div class="well">
    In order to send messages for new users etc. you have to configure the connection over smtp protocule.
</div>
<div class="form-group">
<label for="smtpHost">Host</label>
<input name="smtpForm[host]" value="<?= isset($input['smtpForm']['host']) ? $input['smtpForm']['host'] : '' ?>" type="text" class="form-control" id="smtpHost" placeholder="mail.domain.com">
</div>
<div class="form-group">
<label for="smtpUser">Username</label>
<input name="smtpForm[user]" value="<?= isset($input['smtpForm']['user']) ? $input['smtpForm']['user'] : '' ?>" type="text" class="form-control" id="smtpUser" placeholder="joe.doe@domain.com">
</div>
<div class="form-group">
    <label for="smtpPassword">Password</label>
    <input name="smtpForm[password]" value="<?= isset($input['smtpForm']['password']) ? $input['smtpForm']['password'] : '' ?>" type="password" class="form-control" id="smtpPassword" placeholder="superSafe!password">
</div>
<div class="form-group">
    <label for="smtpPort">Port</label>
    <input name="smtpForm[port]" value="<?= isset($input['smtpForm']['port']) ? $input['smtpForm']['port'] : '' ?>" type="number" class="form-control" id="smtpPort" placeholder="587">
</div>
<div class="form-group">
    <label for="smtpFrom">Name</label>
    <input name="smtpForm[name]" value="<?= isset($input['smtpForm']['name']) ? $input['smtpForm']['name'] : '' ?>" type="text" class="form-control" id="smtpFrom" placeholder="Joe Doe">
</div>
<div class="form-group">
    <label for="smtpEmail">Email</label>
    <input name="smtpForm[email]" value="<?= isset($input['smtpForm']['email']) ? $input['smtpForm']['email'] : '' ?>" type="email" class="form-control" id="smtpEmail" placeholder="joe.doe@domain.com">
</div>