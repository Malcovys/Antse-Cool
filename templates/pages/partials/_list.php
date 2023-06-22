<div class="col grid-margin stretch-card overflow-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= $title; ?></h4>
            <form action="index.php?action=search" method="get">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                        <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" name="<?= $contexte ?>" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
                </div>
            </form>
            <div class="table-responsive pt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Matricule</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>E-mail</th>
                            <?php 
                            if($contexte === 'student') { 
                            ?>
                                <th>Level</th>
                                <th>Promotion</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($listInfos as $infos){ 
                        ?>
                        <tr>
                            <td class="py-1"><img src="<?= $infos['photo_dir'];?>" alt="image"/></td>
                            <td><?= $infos['id'];?></td>
                            <td><?= $infos['firstName'];?></td>
                            <td><?= $infos['lastName'];?></td>
                            <td><?= $infos['email'];?></td>
                            <?php 
                            if($contexte === 'student') { 
                            ?>
                                <td><?= $infos['group']; ?></td>
                                <td><?= $infos['promotion']; ?></td>
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