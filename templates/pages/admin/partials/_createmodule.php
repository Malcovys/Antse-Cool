<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= 'Create Module From'; ?></h4>
            <form class="forms-sample" action="index.php?action=insert-module" method="post">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Code</label>
                    <input type="text" name="code" class="form-control" placeholder="Code">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Classe</label>
                    <select class="form-control form-control-lg" name="group">
                        <?php
                        foreach($groupList as $group) {
                        ?>
                        <option><?= $group['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Teacher</label>
                    <select class="form-control form-control-lg" name="teacher">
                        <?php
                        foreach($teachersList as $teacher) {
                        ?>
                        <option value="<?= $teacher['id']; ?>"><?= $teacher['id'].' : '.$teacher['firstName'].' '.$teacher['lastName']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light"><a href="index.php" style="text-decoration: none;">Cancel</a></button>
            </form>
        </div>
    </div>
</div>