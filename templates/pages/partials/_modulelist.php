<div class="grid-margin stretch-card overflow-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Modules list</h4>
            <div class="table-responsive">
                <pre>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Level</th>
                            <th>Teachers</th>
                            <?php
                            if ($contexte == 'admin') {
                            ?>
                            <th>Action</th>
                            <?php
                            }
                            ?>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($listModules as $module){
                    ?>
                    <tr>
                        <td><?= $module['module_name']; ?></td>
                        <td><?= $module['module_id']; ?></td>
                        <td><?= $module['group']; ?></td>
                        <td><?= $module['teacher']; ?></td>
                        <?php
                        if ($contexte == 'admin') {
                        ?>
                        <td>
                            <a href="index.php?action=edit-module&id=<?= $module['module_id']; ?>&group=<?= $module['group']; ?>">
                                <button class="badge badge-info" style="border: none;">Edit</button>
                            </a>
                        </td>
                        <?php
                        }
                        ?> 
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