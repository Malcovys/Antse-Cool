<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="">
            <i class=""></i>
            <span class=""></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#esti" aria-expanded="false" aria-controls="esti">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">ESTI</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="esti">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="index.php?action=profs-list">Professors</a></li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=students-list">Students</a></li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=module-list">Modules</a></li>
              </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#grades" aria-expanded="false" aria-controls="notes">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Grade</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="grades">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="index.php?action=addgrade-page">Give grade</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#timetable" aria-expanded="false" aria-controls="scheldules">
                <i class="ti-calendar menu-icon"></i>
                    <span class="menu-title">Timetable</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="timetable">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="index.php?action=mytimetable">My Timetable</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?action=estitimetable">ESTI's Timetable</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>