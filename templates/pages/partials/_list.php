<div class="grid-margin stretch-card overflow-auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= $title; ?></h4>
            <div class="table-responsive pt-3">
            <pre>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Matricule</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>E-mail</th>
                            <?php 
                            if($contexte === 'student' && $contexte == 'admin') { 
                            ?>
                                <th>Level</th>
                                <th>Promotion</th>
                            <?php
                            }
                            ?>
                            <?php 
                                if($contexte == 'admin') { 
                                ?>
                                <th>Actions</th>
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
                            if($contexte === 'student' && $contexte == 'admin') { 
                            ?>
                                <td><label class="badge badge-warning"><?= $infos['group']; ?></label></td>
                                <td><label class="badge badge-danger"><?= $infos['promotion']; ?></label></td>
                            <?php
                            }
                            ?>
                            <?php 
                            if ($contexte === 'admin') {
                            ?>
                                <td>
                                <?php
                                if ($title == 'Professors list'){
                                ?>
                                    <a href="index.php?action=edit-prof&id=<?= $infos['id'];?>"><button class="badge badge-info" style="border: none;">Edit</button></a>
                                <?php
                                }
                                ?>
                                 <?php
                                if ($title == 'Students list'){
                                ?>
                                    <a href="index.php?action=edit-student&id=<?= $infos['id'];?>"><button class="badge badge-info" style="border: none;">Edit</button></a>
                                <?php
                                }
                                ?>   
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