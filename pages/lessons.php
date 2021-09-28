<?php include_once('../includes/load.php');
   $user = current_user();
   if (!$session->isUserLoggedIn(true)) {
       redirect('../index', false);
   }
   if($user['tipo']=="Docente"){
       redirect('./lessonsTeachers', false);
   }

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
  <link rel="stylesheet" href="../assets/dist/css/bootstrap-clockpicker.css">
 

</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">


    <?php include('../layout/nav.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
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


      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col"></div>
            <div class="col-10">
              <br>
              <div id="CalendarioWeb"></div>
            </div>
            <div class="col"> </div>
          </div>
        </div>

      </section>


    </div>
    <?php include('../layout/footer.php'); ?>
    <!-- Modal(Agregar, Modificar, Eliminar) -->
    <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tituloEvento"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="txtID" name="txtID" />
            <div class="form-group">
            <label>Fecha Seleccionada:</label>
            <input type="text" id="txtFecha" name="txtFecha" class="form-control" readonly />
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label>Titulo:</label>
                <input type="text" id="txtTitulo" name="txtFecha" class="form-control" placeholder="Titulo del evento" />
              </div>
              <div class="form-group col-md-4">
                <label>Hora del evento:</label>
                <div class="input-group clockpicker" data-autoclose="true">
                  <input type="text" id="txtHora" value="10:30" class="form-control" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Descripcion:</label>
              <textarea id="txtDescripcion" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label>Color:</label>
              <input type="color" id="txtColor" value="#ff0000" name="txtFecha" class="form-control" style="height: 36px;" /><br>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
            <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
            <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>

    <!-- /.content-wrapper -->
    <script>
      $(document).ready(function() {
        $('#CalendarioWeb').fullCalendar({
          header: {
            left: 'today, prev, next',
            center: 'title',
            right: 'month, basicWeek, basicDay, agendaWeeb, agendaDay'
          },

          dayClick: function(date, jsEvent, view) {
            $('#btnAgregar').prop("disabled", false);
            $('#btnModificar').prop("disabled", true);
            $('#btnEliminar').prop("disabled", true);
            limpiarFormulario();
            $('#txtFecha').val(date.format());
            $("#ModalEventos").modal();
          },

          events: 'http://localhost/coordinacionGeam/includes/eventos.php',

          eventClick: function(calEvent, jsEvent, view) {
            $('#btnAgregar').prop("disabled", true);
            $('#btnModificar').prop("disabled", false);
            $('#btnEliminar').prop("disabled", false);
            //H2
            $('#tituloEvento').html(calEvent.title);
            //MOSTRAR LA INFORMACION DEL EVENTO EN LOS INPUTS
            $('#txtDescripcion').val(calEvent.descripcion);
            $('#txtID').val(calEvent.id);
            $('#txtTitulo').val(calEvent.title);
            $('#txtColor').val(calEvent.color);
            FechaHora = calEvent.start._i.split(" ");
            $('#txtFecha').val(FechaHora[0]);
            $('#txtHora').val(FechaHora[1]);
            $("#ModalEventos").modal();
          },
          editable: true,
          eventDrop: function(calEvent) {
            $('#txtID').val(calEvent.id);
            $('#txtTitulo').val(calEvent.title);
            $('#txtColor').val(calEvent.color);
            $('#txtDescripcion').val(calEvent.descripcion);
            var fechaHora = calEvent.start.format().split("T");
            $('#txtFecha').val(fechaHora[0]);
            $('#txtHora').val(fechaHora[1]);
            RecolectarDatosGUI();
            EnviarInformacion('modificar', NuevoEvento, true);
          }

        });

      });
    </script>


    <script>
      var NuevoEvento;

      $('#btnAgregar').click(function() {
        RecolectarDatosGUI();
        EnviarInformacion('agregar', NuevoEvento);
      });
      $('#btnEliminar').click(function() {
        RecolectarDatosGUI();
        EnviarInformacion('eliminar', NuevoEvento);
      });
      $('#btnModificar').click(function() {
        RecolectarDatosGUI();
        EnviarInformacion('modificar', NuevoEvento);
      });


      function RecolectarDatosGUI() {
        NuevoEvento = {
          id: $('#txtID').val(),
          title: $('#txtTitulo').val(),
          start: $('#txtFecha').val() + " " + $('#txtHora').val(),
          color: $('#txtColor').val(),
          descripcion: $('#txtDescripcion').val(),
          textColor: "#FFFFFF",
          end: $('#txtFecha').val() + " " + $('#txtHora').val()
        };
      }

      function EnviarInformacion(accion, objEvento, modal) {
        $.ajax({
          type: 'POST',
          url: '../includes/eventos.php?accion=' + accion,
          data: objEvento,
          success: function(msg) {
            if (msg) {
              $('#CalendarioWeb').fullCalendar('refetchEvents');
              if (!modal) {
                $("#ModalEventos").modal('toggle');
              }

            }
          },
          error: function() {
            alert("Hay un error...");
          }
        });
      }

      $('.clockpicker').clockpicker();

      function limpiarFormulario() {
        $('#txtID').val('');
        $('#txtTitulo').val('');
        $('#txtColor').val('');
        $('#txtDescripcion').val('');
      }
    </script>
   
</body>

</html>