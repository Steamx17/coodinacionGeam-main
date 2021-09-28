<?php include_once('includes/load.php');
if ($session->isUserLoggedIn(true)) {
  redirect('./pages/dashboard', false);
}

if (isset($_POST['user']) && isset($_POST['password'])) {

  $req_fields = array('user', 'password');
  validate_fields($req_fields);
  $username = removeJunk($_POST['user']);
  $password = removeJunk($_POST['password']);
  $existUser = findUserId($username);
  echo $existUser['total'];
  if ($existUser['total'] >= 1) {
    if (empty($errors)) {
      $user_id = authenticate($username, $password);
      if ($user_id) {
        $session->login($user_id);
        updateLastLogIn($user_id);
        $user = current_user();
        if ($user['tipo'] != "Docente") {
          $session->msg("s", "Bienvenido  de nuevo " . $user['name']);
          header("Location: ./pages/dashboard");
        } else {
          $session->msg("s", "Bienvenido  de nuevo " . $user['name']);
          header("Location: ./pages/lessonsTeachers");
        }
      } else {
        $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
        header("Location: index");
      }
    } else {
      $session->msg("d", $errors);
      header("Location: index");
    }
  } else {
    $session->msg("w", "El usuario ".$username." no se encuentra registrado.");
    header("Location: index");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión | GEAM </title>
  <link rel="icon" href="assets/dist/img/favicon.ico">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="background-color:#FFFFFF;">
  <?php echo displayMSG($msg); ?>

  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="assets/dist/img/logos/300 -63.png">
      </div>
      <div class="card-body">
        <p class="login-box-msg">Iniciar sesión</p>
        <form action="index" method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="user" name="user"           
            required placeholder="Usuario" title="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" required name="password" placeholder="Password" title="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-8">
              <div class="form-group mb-0">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                  <label class="custom-control-label" for="exampleCheck1">Ver Contraseña.</label>
                </div>
              </div>
            </div>
            <br>
            <div class="col-4">
              <button type="submit" title="Ingresar" class="btn btn-primary btn-block">Ingresar</button>
            </div>
          </div>
        </form>
      </div>

      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <footer class="">
            <strong>Copyright &copy; 2021 <a href="#" data-toggle="modal" data-target="#exampleModaIam">
                Sistema de gestión académica - Grupo Educativo Abel Mendoza, desarrollado por Adrián Andres Atencia Caly </a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
              <b>Version</b> 1.0
            </div>
          </footer>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModaIam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Desarrollado por: </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="card card-widget widget-user">
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">Adrián Andrés Atencia Caly</h3>
                <h5 class="widget-user-desc">Ingeniero de sistemas.</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="assets/dist/img/my.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3133580263</h5>
                      <span class="description-text">Contacto</span>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-5 border-right">
                    <div class="description-block">
                      <h5 class="description-header">adrianandres1998@gmail.com</h5>
                      <span class="description-text">Correo</span>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">Github</h5>
                      <span class="description-text"><a href="https://github.com/AdrianAtenciaCaly" target="_blank">AdrianAtenciaCaly</a></span>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="assets/plugins/toastr/toastr.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {
      $('#exampleCheck1').click(function() {
        if ($('#exampleCheck1').is(':checked')) {
          $('#password').attr('type', 'text');
        } else {
          $('#password').attr('type', 'password');
        }
      });
    });
  </script>

</body>

</html>