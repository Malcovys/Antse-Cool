<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <?= $lastName;?></h3>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-light bg-white" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (<?= date("d M Y"); ?>)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="templates/assets/images/dashboard/people.svg" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div class="d-flex"> 
                                <img class="bg bg-secondary" src="https://openweathermap.org/img/wn/<?=$weather['icon'];?>.png"/>
                                <h3 class="mt-2"><?=$weather['temp'];?><sup>C</sup></h3>
                            </div>
                            <div class="ml-1">
                                <h4 class="location font-weight-normal">Antananarivo</h4>
                                <h6 class="font-weight-normal">Madagascar</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">My classmate(s)</p>
                            <p class="fs-30 mb-2"><?= $totalClassMate; ?></p>
                            <p><?= $totalClassMatePourcent; ?>% (Esti students)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">My professor(s)</p>
                            <p class="fs-30 mb-2"><?= $totalTeacher; ?></p>
                            <p><?= $totalTeacherPourcent; ?>% (Esti Professors)</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">My schedules</p>
                            <p class="fs-30 mb-2"><?= $totaleCoursLeft; ?></p>
                            <p>Cours left</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>