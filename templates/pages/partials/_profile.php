<div class="container bootstrap snippets bootdey mb-5 mt-4">
    <hr>
    <div class="row">
        <div class="col-md-12 d-flex">
            <div class="col-5">
                <div class="form-col">
                    <img src="<?= $photoDir ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                </div>
            </div>
            <div class="col-7">
                <div class="row d-flex flex-column mt-1">
                    <span>First name: <?= $infos['firstName']; ?></span>
                    <span>Last name: <?= $infos['lastName']; ?></span>
                    <span>Matricule: <?= $infos['id']; ?></span>
                    <?php
                    if($contexte == 'student') {
                    ?>
                        <span>Level: <?= $infos['group']; ?></span>
                        <span>Promotion: <?= $infos['promotion']; ?></span>
                    <?php
                    }
                    ?>
                    <span>Email: <?= $infos['email']; ?></span>
                    <a href="index.php?action=edit-profile">Edite</a>
                </div>
            </div>
        </div>
    </div>
</div>