<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Scheldule Form</h4>
            <form class="forms-sample" action="index.php?action=insert-scheldule" method="post">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <select class="form-control form-control-lg" name="module">
                        <?php
                        foreach($moduleList as $module) {
                        ?>
                        <option><?= $module['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
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
                    <label for="exampleInputEmail3">Date</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Begin hour</label>
                    <input type="time" name="begin-hour" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">End hour</label>
                    <input type="time" name="end-hour" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light"><a href="index.php" style="text-decoration: none;">Cancel</a></button>
            </form>
        </div>
    </div>
</div>