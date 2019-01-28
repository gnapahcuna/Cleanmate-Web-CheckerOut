<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: Login.php');
}

?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="brand">
    <a href="Home-Factory.php"><img src="assets/img/logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
  </div>
  <div class="container-fluid">
    <div class="navbar-btn">
      <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
    </div>


    <div id="navbar-menu">
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/icon.png" class="img-circle" alt="Avatar"> <span><?php echo $_SESSION['username']; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="Logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
