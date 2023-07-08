<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Choise group</h4>
            <?php
            foreach($groupList as $group) {
            ?>
            <a class="text-light" href="index.php?action=scheldule&group=<?= $group['name']; ?>">
                <button class="btn btn-info btn-lg btn-block mb-2"><?= $group['name'];?></button>
            </a>
            <?php
            }
            ?>
        </div>
    </div>
</div>