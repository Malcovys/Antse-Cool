<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= $title; ?></h4>
            <?php
            foreach($timeTable as $scheldule) {
            ?>
            <button class="btn btn-secondary btn-lg btn-block text-left ">
                <div>
                    <h6><?= date("F j", strtotime($scheldule['date'])); ?></h6>
                    <h4>
                        <?= $scheldule['module_id'].' : '. $scheldule['module']; ?>
                        <?php
                        if (isset($scheldule['group'])){ echo '('.$scheldule['group'].')';}
                        ?>
                    </h4>
                    <h6><?= date("H:i", strtotime($scheldule['begin_at'])).' - '.date("H:i", strtotime($scheldule['end_at'])); ?></h6>
                    <?php
                    if (isset($_COOKIE['role']) && $_COOKIE['role'] == 'Admin'){
                    ?>
                    <a href="index.php?action=delScheldule&id=<?=$scheldule['id'];?>&group=<?=$group_name;?>" style="color: red;">Delete</a>
                    <?php
                    }
                    ?>
                </div>
            </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>