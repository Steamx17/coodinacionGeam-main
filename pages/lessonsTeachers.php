<?php
include_once('../includes/load.php');
$user = current_user();

if (!$session->isUserLoggedIn(true)) {
  redirect('../index', false);
}
$teachers = findAllTeachers();
$group = findAllgroup();
$idTeacher = findIdTeacher($user['name']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clases | GEAM</title>
  <link rel="icon" href="../assets/dist/img/favicon.ico">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- JQVMap -->
  <link rel="stylesheet" href="../assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/dist/css/fullcalendar.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php include('../layout/nav.php'); ?>
  <div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Clase</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <?php echo displayMSG($msg); ?>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Calendario de clases para: <?php echo $user['name'] ?></h3>

              </div>
              <div class="card-body">

                <div class="col-12">
                  <div id="CalendarioWeb"></div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include('../layout/footer.php'); ?>

  <script>
    $(document).ready(function() {

      $('#CalendarioWeb').fullCalendar({

        header: {
          themeSystem: 'bootstrap',
          left: 'today, prev, next',
          center: 'title',
          right: 'month, basicWeek, basicDay, timeGridWeek, timeGridDay,listMonth'

        },

        dayClick: function(date, jsEvent, view) {
          $('#btnAgregar').prop("disabled", false);
          $('#btnModificar').prop("disabled", true);
          $('#btnEliminar').prop("disabled", true);
          limpiarFormulario();
          $('#txtFecha').val(date.format());
          $("#ModalEventos").modal();
        },

        events: '../includes/eventosteachers.php?profesor=<?php echo $user['name'] ?>',


        eventClick: function(calEvent, jsEvent, view) {
          $('#btnAgregar').prop("disabled", true);
          $('#btnModificar').prop("disabled", false);
          $('#btnEliminar').prop("disabled", false);
          //H2
          $('#tituloEvento').html(calEvent.title);
          //MOSTRAR LA INFORMACION DEL EVENTO EN LOS INPUTS
          $('#txtDescripcion').val(calEvent.description);
          $('#txtID').val(calEvent.id_lessons);
          $('#txtTitulo').val(calEvent.title);
          $('#txtColor').val(calEvent.color);

          FechaHora = calEvent.start._i.split(" ");
          $('#txtFecha').val(FechaHora[0]);
          $('#txtHora').val(FechaHora[1]);
          $('#gruposelect').val(calEvent.namegroup_lessons);
          $('#profesorselect').val(calEvent.teacher_lessons);
          $("#ModalEventos").modal();
        },
        editable: false,
        eventDrop: function(calEvent) {
          $('#txtID').val(calEvent.id_lessons);
          $('#txtTitulo').val(calEvent.title);
          $('#txtColor').val(calEvent.color);
          $('#txtdescription').val(calEvent.description);
          var fechaHora = calEvent.start.format().split("T");
          $('#txtFecha').val(fechaHora[0]);
          $('#txtHora').val(fechaHora[1]);
          $('#txtdescription').val(calEvent.description);
          $('#gruposelect').val(calEvent.namegroup_lessons);
          $('#profesorselect').val(calEvent.teacher_lessons);

          RecolectarDatosGUI();

        }

      });

    });
  </script>
  <!-- Modal(Agregar, Modificar, Eliminar) -->
  <div class="modal fade bd-example-modal-lg" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <div class="col-md-12">
            <div class="card card-primary ">
              <div class="card-header">
                <h3 class="card-title">Datos de la clase</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <input type="hidden" id="txtID" name="txtID" />
                <div class="form-group">
                  <label>Fecha :</label>
                  <input type="text" id="txtFecha" name="txtFecha" class="form-control" readonly />
                </div>
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <label>Titulo:</label>
                    <input type="text" id="txtTitulo" name="txtFecha" readonly class="form-control" placeholder="Titulo del evento" onkeyup="javascript:this.value=this.value.toUpperCase();" required />
                  </div>
                  <div class="form-group col-md-4">
                    <label>Hora del evento:</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" id="txtHora" value="10:30" class="form-control" readonly />
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-md-6">

                    <input type="text" id="profesorselect" class="form-control" readonly />
                  </div>
                  <div class="col-md-6">

                    <input type="text" id="gruposelect" class="form-control" readonly />
                  </div>
                </div>
                <div class="form-group">
                  <label>Descripcion:</label>
                  <textarea id="txtDescripcion" rows="5" class="form-control" readonly onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>


  <script>
    function RecolectarDatosGUI() {
      NuevoEvento = {
        id_lessons: $('#txtID').val(),
        title: $('#txtTitulo').val(),
        start: $('#txtFecha').val() + " " + $('#txtHora').val(),
        color: $('#txtColor').val(),
        description: $('#txtDescripcion').val(),
        textColor: "#FFFFFF",
        end: $('#txtFecha').val() + " " + $('#txtHora').val(),
        teacher_lessons: $('#profesorselect').val(),
        namegroup_lessons: $('#gruposelect').val()
      };
    }
  </script>

</body>

</html>