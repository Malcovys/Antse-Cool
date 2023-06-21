<div class="col-lg-12 grid-margin stretch-card">
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-1"><img src="../../images/faces/face7.jpg" alt="image"/></td>
                            <td>1</td>
                            <td>Herman</td>
                            <td>Beck</td>
                            <td>Beck</td>
                        </tr>
                        <tr>
                            <td class="py-1"><img src="../../images/faces/face7.jpg" alt="image"/></td>
                            <td>1</td>
                            <td>Herman</td>
                            <td>Beck</td>
                            <td>Beck</td>
                        </tr>
                        <tr>
                            <td class="py-1"><img src="../../images/faces/face7.jpg" alt="image"/></td>
                            <td>1</td>
                            <td>Herman</td>
                            <td>Beck</td>
                            <td>Beck</td>
                        </tr>
                        <tr>
                            <td class="py-1"><img src="../../images/faces/face7.jpg" alt="image"/></td>
                            <td>1</td>
                            <td>Herman</td>
                            <td>Beck</td>
                            <td>Beck</td>
                        </tr>
                        <tr>
                            <td class="py-1"><img src="../../images/faces/face7.jpg" alt="image"/></td>
                            <td>1</td>
                            <td>Herman</td>
                            <td>Beck</td>
                            <td>Beck</td>
                        </tr>
                        <tr>
                            <td class="py-1"><img src="../../images/faces/face7.jpg" alt="image"/></td>
                            <td>1</td>
                            <td>Herman</td>
                            <td>Beck</td>
                            <td>Beck</td>
                        </tr>
                        <tr>
                            <td class="py-1"><img src="../../images/faces/face7.jpg" alt="image"/></td>
                            <td>1</td>
                            <td>Herman</td>
                            <td>Beck</td>
                            <td>Beck</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>