<div class="col grid-margin stretch-card overflow-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Grades</h4>
            <form action="index.php?action=search" method="get">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                        <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" name="grades" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
                </div>
            </form>
            <div class="table-responsive pt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Codes</th>
                            <th>Modules</th>
                            <th>Grades</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($grades as $grade) {
                    ?>
                        <tr>
                            <td><?= $grade['module_id']?></td>
                            <td><?= $grade['module']?></td>
                            <td><label class="badge badge-info"><?= $grade['grade']?></label></td>
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