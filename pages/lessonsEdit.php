<?php include_once('../includes/load.php');
$user = current_user();
if (!$session->isUserLoggedIn(true)) {
  redirect('../index', false);
}
if ($user['tipo'] == "Docente") {
  redirect('./lessonsTeachers', false);
}
$teachers = findAllTeachers();
$group = findAllgroup();

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
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-suc">
              <div class="card-header">
                <h3 class="card-title">Calendario de clases</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col"></div>
                  <div class="col-8">
                    <div id="CalendarioWeb"></div>
                  </div>
                  <div class="col"> </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include('../layout/footer.php'); ?>

    <!-- /.content-wrapper -->
    <script>
      $(function() {
        $(document).on('change', '#profesor', function() { //detectamos el evento change
          var value = $("#profesor option:selected").text();
          $('#profesorselect').val(value); //le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
        });
      });
      $(function() {
        $(document).on('change', '#grupo', function() { //detectamos el evento change
          var value = $("#grupo option:selected").text();
          $('#gruposelect').val(value); //le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
        });
      });
      $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
      })
    </script>
    <script>
      $(document).ready(function() {

        $('#CalendarioWeb').fullCalendar({
          header: {
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

          events: '../includes/eventos.php',

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
          buttonIcons: true,
          weekNumbers: false,
          editable: true,
          eventLimit: true,
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
            EnviarInformacion('modificar', NuevoEvento, true);
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
                  <h3 class="card-title">Añadir/Editar/Eliminar Eventos</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <input type="hidden" id="txtID" name="txtID" />
                  <div class="form-group">
                    <label>Fecha Seleccionada:</label>
                    <input type="text" id="txtFecha" name="txtFecha" class="form-control" readonly />
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-8">
                      <label>Titulo:</label>
                      <input type="text" id="txtTitulo" name="txtFecha" class="form-control" placeholder="Titulo del evento" onkeyup="javascript:this.value=this.value.toUpperCase();" required />
                    </div>
                    <div class="form-group col-md-4">
                      <label>Hora del evento:</label>
                      <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" id="txtHora" value="10:30" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institucion"> Profesor </label>
                        <select id="profesor" name="profesor" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione una opción </option>
                          <?php foreach ($teachers as $teachers) :
                            if ($teachers['status'] == "INACTIVE") {
                          ?>
                              <option value="<?php echo removeJunk($teachers['id_teacher']); ?>" disabled hidden><?php echo removeJunk($teachers['fullname_teacher'] . " -  " . $teachers['name_subject']); ?></option>
                            <?php
                            } else {
                            ?>
                              <option value="<?php echo removeJunk($teachers['id_teacher']); ?>"><?php echo removeJunk($teachers['fullname_teacher']); ?></option>
                            <?php
                            }
                            ?>
                          <?php endforeach; ?>
                        </select>

                      </div>
                      <input type="text" id="profesorselect" class="form-control" readonly />
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="grupo"> Grupo </label>
                        <select id="grupo" name="grupo" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione una opción </option>
                          <?php foreach ($group as $group) : ?>
                            <option value="<?php echo removeJunk($group['id_group']); ?>"><?php echo  removeJunk($group['name_group']); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <input type="text" id="gruposelect" class="form-control" readonly />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Descripcion:</label>
                    <textarea id="txtDescripcion" rows="5" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Color:</label>
                    <input type="color" id="txtColor" value="#ff0000" name="txtFecha" class="form-control" style="height: 36px;" /><br>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
            <button type="button" id="btnModificar" class="btn btn-info">Modificar</button>
            <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
            <br>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


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
        $('#profesorselect').val('');
        $('#gruposelect').val('');
        $('#profesor option').prop('selected', function() {
          return this.defaultSelected;
        });
      }
    </script>

</body>

</html>