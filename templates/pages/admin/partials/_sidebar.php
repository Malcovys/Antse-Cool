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
        <a class="nav-link" data-toggle="collapse" href="#list" aria-expanded="false" aria-controls="tables">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Lists</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="list">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="index.php?action=students-list">Students</a></li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=profs-list">Teachers</a></li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=module-list">Modules</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#create" aria-expanded="false" aria-controls="tables">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Create</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="create">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="index.php?action=create-student">Students</a></li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=create-teacher">Teachers</a></li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=create-module">Modules</a></li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=create-scheldule">Scheldule</a></li>
            </ul>
        </div>
    </li>
    
  </ul>
</nav>