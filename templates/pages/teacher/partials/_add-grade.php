<div class="col grid-margin stretch-card overflow-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add grades</h4>
            <div class="table-responsive pt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Codes</th>
                            <th>Modules</th>
                            <th>Group</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($myModules as $module) {
                    ?>
                        <tr>
                            <td><?= $module['module_id']?></td>
                            <td><?= $module['module']?></td>
                            <td>
                                <label class="badge badge-warning">
                                    <?= $module['group']?></td>
                                </label>
                            <td>
                                <a href="index.php?action=edit-grade&mod=<?=$module['module_id'];?>&group=<?=$module['group'];?>">
                                    <button class="btn btn-primary btn-sm" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>