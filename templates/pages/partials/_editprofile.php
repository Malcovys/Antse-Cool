<div class="container bootstrap snippets bootdey mb-5 mt-4">
    <h1 class="text-primary">Edit Profile</h1>
    <hr>
    <div class="form-row">
        <div class="col-md-11 personal-info">
            <form class="form-horizontal d-flex" enctype="multipart/form-data" action="index.php?action=update-profile" method="post" >
                <div class="col-5">
                    <div class="form-group">
                        <div class="form-col">
                            <div class="text-center">
                                <img src="<?= $photoDir ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                                <div class="mb-3">
                                <label for="formFileSm" class="form-label">Upload new photo ?</label>
                                <input class="form-control form-control-sm" id="formFileSm" name="photo" type="file">
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="col-7">
                    <h3>Personal info</h3>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">First name:</label>
                        <div class="col-lg-12">
                            <input class="form-control" name="firstName" type="text" value="<?= $firstName; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">Last name:</label>
                        <div class="col-lg-12">
                            <input class="form-control" name="lastName" type="text" value="<?= $lastName; ?>">
                        </div>
                    </div>
                    <div class="text-right mt-5 mb-1 form-group">
                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                        <button class="btn btn-default"><a href="index.php?action=profile">Cancel</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>