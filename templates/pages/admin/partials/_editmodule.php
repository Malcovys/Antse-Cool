<div class="container bootstrap snippets bootdey mb-5 mt-4">
    <h1 class="text-primary"><?= $infos['module_id'].'-'.$infos['group'] ?></h1>
    <hr>
    <div class="form">
        <div class="col personal-info">
            <form class="form-horizontal d-flex" action="index.php?action=update-module&id=<?= $infos['module_id']; ?>&group=<?= $infos['group']; ?>" method="post" >
                <div class="col-7">
                    <h3>Infos</h3>
                    <div class="form-group">
                        <label>Name:</label>
                        <div>
                            <input class="form-control" name="name" type="text" value="<?= $infos['module_name'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teacher Name:</label>
                        <div class="form-group">
                            <input class="form-control" name="teacher" type="text" value="<?= $infos['teacher'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teacher Matricule:</label>
                        <div class="form-group">
                            <input class="form-control" name="teacherMatricule" type="text" value="<?= $infos['teacherMatricule'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">State:</label>
                        <div class="">
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