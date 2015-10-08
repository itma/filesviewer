<h3>1. Website</h3>
<div class="well">
    Fill the form with the basic information about the website you are going to publish.
</div>
<div class="form-group">
<label for="websiteName">Website name</label>
<input name="websiteForm[name]" value="<?= isset($input['websiteForm']['name']) ? $input['websiteForm']['name'] : '' ?>" type="text" class="form-control" id="websiteName" placeholder="Example name">
</div>
<div class="form-group">
<label for="websiteUrl">Url</label>
<input name="websiteForm[url]" value="<?= isset($input['websiteForm']['url']) ? $input['websiteForm']['url'] : '' ?>" type="url" class="form-control" id="websiteUrl" placeholder="http://domain.com">
</div>
<div class="form-group">
    <label for="websiteOwner">Owner's name</label>
    <input name="websiteForm[owner]" value="<?= isset($input['websiteForm']['owner']) ? $input['websiteForm']['owner'] : '' ?>" type="text" class="form-control" id="websiteOwner" placeholder="Joe Doe">
</div>
<div class="form-group">
    <label for="websiteEmail">Owner's email</label>
    <input name="websiteForm[email]" value="<?= isset($input['websiteForm']['email']) ? $input['websiteForm']['email'] : '' ?>" type="email" class="form-control" id="websiteEmail" placeholder="joe.doe@domain.com">
</div>
<div class="form-group">
    <label for="websiteLanguage">Language of the webiste</label>
    <select class="form-control" name="websiteForm[language]" id="websiteLanguage">
        <option value="en_gb">English (GB)</option>
        <option value="pl_pl">Polish</option>
    </select>
</div>