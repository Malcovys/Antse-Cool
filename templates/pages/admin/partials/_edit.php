<div class="container bootstrap snippets bootdey mb-5 mt-4">
    <h1 class="text-primary"><?= $infos['id'] ?></h1>
    <hr>
    <div class="form-row">
        <div class="col-md-11 personal-info">
            <form class="form-horizontal d-flex" action="index.php?action=update-<?= $contexte; ?>&id=<?= $infos['id'] ?>" method="post" >
                <div class="col-5">
                    <div class="form-group">
                        <div class="form-col">
                            <img src="<?= $infos['photo_dir'] ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                        </div>    
                    </div>
                </div>
                <div class="col-7">
                    <h3>Infos</h3>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">First name:</label>
                        <div class="col-lg-12">
                            <input class="form-control" name="firstName" type="text" value="<?= $infos['firstName'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">Last name:</label>
                        <div class="col-lg-12">
                            <input class="form-control" name="lastName" type="text" value="<?= $infos['lastName'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">Email:</label>
                        <div class="col-lg-12">
                            <input class="form-control" name="email" type="text" value="<?= $infos['email'] ?>">
                        </div>
                    </div>
                    <?php
                    if ($contexte == 'student') {
                    ?>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">Level:</label>
                        <div class="col-lg-12">
                        <input class="form-control" name="group" type="text" value="<?= $infos['group'] ?>">
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-lg-5 control-label">State:</label>
                        <div class="col-lg-12">
                            <input class="form-control" name="state" type="text" value="<?= $infos['state'] ?>">
                        </div>
                    </div>
                    <div class="text-right mt-5 mb-1 form-group">
                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                        <button class="btn btn-default"><a href="index.php">Cancel</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>