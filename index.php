<?php
  session_start();
  require_once("config.php");
  require_once("inc/classes/user.class.php");
  require_once("inc/classes/core.class.php");
  try{
    $db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
    $route_db = new mysqli($config['route_db']['host'],$config['route_db']['user'], $config['route_db']['password'],$config['route_db']['name']);
    if($db->connect_errno) throw new Exception($db->connect_errno);
    $user = new User(0,$_SESSION['id']);
    $core = new Core();
    if($user->loginError) header('Location:login.php');
  } catch(Exception $e) {
    echo $e->getMessage();
    exit();
  }

?>
<!DOCTYPE html>
<html lang="pl">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Route 68 - Kartoteka</title>

  <link rel="shortcut icon" type="image/png" href="police.png"/>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-landmark"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LSPD</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Strona Glowna</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="?page=cars">
          <i class="fas fa-car fa-fw"></i>
          <span>Baza pojazdów</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Kartoteka
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="?page=kartoteka">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Przegląd</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=kartoteka_add">
          <i class="fas fa-fw fa-file-upload"></i>
          <span>Dodaj wpis</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Raporty
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="?page=reports">
          <i class="fas fa-clipboard-list fa-fw"></i>
          <span>Przegląd</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=report_add">
        <i class="far fa-clipboard fa-fw"></i>
          <span>Dodaj wpis</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Policjanci
      </div>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="?page=police_list">
          <i class="fas fa-fw fa-users"></i>
          <span>Lista policjantów</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <?php
          $pages = $config['template']['pages_path'];
          $page = $_GET['page'];
          $ext = $config['template']['extension'];
          $home_page = $config['template']['home_page'];
          $err_page = $config['template']['err_page'];
          include($config['template']['navigation']);
          if(!empty($page)&&isset($page))
            if(file_exists($pages.$page.$ext)) include($pages.$page.$ext);
            else include($pages.$err_page);
          else include($pages.$home_page);
        ?>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="row">
            <div class="col-md">
              <div class="copyright text-center text-md-left my-auto">
                <span>Created by Om4n3k</span>
              </div>
            </div>
            <div class="col-md">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; LSPD 2019</span>
              </div>
            </div>
            <div class="col-md">
              <div class="copyright text-center text-md-right my-auto">
                <span>v1.3.0.0</span>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="js/notify.min.js"></script>
  <script src="js/ajax.js"></script>
  <script src="js/pagination.js"></script>

  <script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $(document).ready(function(){
      $('#find_person').submit(function(e){
        $('#find_person_result').removeClass("d-none");
        $('#find_person_result').addClass("d-block");
        e.preventDefault();
      });
    });
  </script>

</body>

</html>
