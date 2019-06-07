<?php
  session_start();
  require_once("config.php");
  require_once("inc/classes/user.class.php");
  require_once("inc/classes/kartoteka.class.php");
  try{
    $db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
    if($db->connect_errno) throw new Exception($db->connect_errno);
    $user = new User(0,$_SESSION['id']);
    if(!$user->loginError) header('Location:index.php');
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

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="card m-3 py-3 border-left-danger" id="login-result-panel">
              <div class="card-body" id="login-result-text">
                
              </div>
            </div>
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Witaj ponownie</h1>
                  </div>
                  <form id="form_login" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="l_login" required aria-describedby="emailHelp" placeholder="Login">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="l_password" required placeholder="Hasło">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Zaloguj
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#login-result-panel').hide();
      $('#form_login').submit(function(e){
        $('#form_login button').removeClass('btn-success');
        $('#form_login button').removeClass('btn-warning');
        $('#form_login button').removeClass('btn-danger');
        let login = $('#l_login').val();
        let password = $('#l_password').val();
        $.ajax({
          url: "inc/login.php",
          type: "POST",
          data: "&login="+login+"&password="+password,
          dataType: "json",
          success: function(msg) {
            if(msg.result) {
              $('#form_login button').addClass('btn-success');
              $('#form_login button').removeClass('btn-primary');
              $('#form_login button').html('Zaloguj <i class="fas fa-fw fa-check-circle"></i>');

              setTimeout(function(){window.location.reload(false);}, 1500);
            } else {
              $('#form_login button').addClass('btn-danger');
              $('#form_login button').removeClass('btn-primary');
              $('#form_login button').html('Zaloguj <i class="fas fa-fw fa-times-circle"></i>');

              $('#login-result-text').html(msg.reason);
              $('#login-result-panel').fadeIn(500);
            }
          },
          error: function() {
            $('#form_login button').addClass('btn-warning');
            $('#form_login button').removeClass('btn-primary');
            $('#form_login button').html('Zaloguj <i class="fas fa-fw fa-question-circle"></i>');
          }
        });
        
        e.preventDefault();
      });
    });
  </script>

</body>

</html>
