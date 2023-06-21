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
      <a class="nav-link" data-toggle="collapse" href="#esti" aria-expanded="false" aria-controls="ui-basic">
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
      <a class="nav-link" data-toggle="collapse" href="#notes" aria-expanded="false" aria-controls="form-elements">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Notes</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="notes">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="index.php?action=note-gride">My notes</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#schedules" aria-expanded="false" aria-controls="charts">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Schedules</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="schedules">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">All schedule</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">My schedule</a></li>
          </ul>
      </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#privacy" aria-expanded="false" aria-controls="auth">
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