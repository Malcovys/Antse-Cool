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
                <li class="nav-item"> <a class="nav-link" href="index.php?action=modules-list">Modules</a></li>
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
                    <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Add grade</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#timetable" aria-expanded="false" aria-controls="scheldules">
                <i class="icon-bar-graph menu-icon"></i>
                    <span class="menu-title">Timetable</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="timetable">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">My Timetable</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ESTI's Timetable</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#presence" aria-expanded="false" aria-controls="presence">
                <i class="icon-grid-2 menu-icon"></i>
                    <span class="menu-title">Presence book</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="presence">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Make presence</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Absences</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
       <a class="nav-link" data-toggle="collapse" href="#privacy" aria-expanded="false" aria-controls="privacy">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">Privacy</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="privacy">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="../pages/user/setting.html">Change password</a></li>
          </ul>
        </div>
    </li>
    </ul>
</nav>