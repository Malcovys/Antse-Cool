<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= 'Create '.$contexte.' from'; ?></h4>
            <form class="forms-sample" action="index.php?action=insert&user=<?= $contexte; ?>" method="post">
                <div class="form-group">
                    <label for="exampleInputName1">First name</label>
                    <input type="text" name="firstName" class="form-control" placeholder="First name">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Last name</label>
                    <input type="text" name="lastName" class="form-control" placeholder="Last name">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Matricule</label>
                    <input type="text" name="matricule" class="form-control" placeholder="Matricule">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <?php
                if ($contexte == 'student'){
                ?>
                <div class="form-group">
                    <label>Level</label>
                    <div class="input-group col-xs-12">
                        <select class="form-control form-control-lg" name="group">
                            <option>L1G1</option>
                            <option>L1G2</option>
                            <option>RSI L2</option>
                            <option>RSI L3</option>
                            <option>IDEV L2</option>
                            <option>IDEV L3</option>
                        </select>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="exampleInputCity1">Promotion</label>
                    <input type="text" name="promotion" class="form-control" placeholder="Promotion">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light"><a href="index.php" style="text-decoration: none;">Cancel</a></button>
            </form>
        </div>
    </div>
</div>