<?php include_once('../includes/load.php');
$user = current_user();
if (!$session->isUserLoggedIn(true)) {
  redirect('../index', false);
}
if ($user['tipo'] == "Docente") {
  redirect('./lessonsTeachers', false);
}
$teachers = findAllTeachers();
$subject = findAllsubject();
$group = findAllgroup();
$asistance = findAllasistanceLimit1000();
$departamentos = findAllDepartaments();
$clases = findAllClass();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrar asistencia | GEAM</title>
  <link rel="icon" href="../assets/dist/img/favicon.ico">
  <!-- Google Font: Source Sans Pro -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Asistencia</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <?php echo displayMSG($msg); ?>
            <div class="card card-navy ">
              <div class="card-header">
                <h3 class="card-title">Registrar asistencia</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form action="../includes/sentences/register_asistence.php" method="POST" enctype="multipart/form-data" id="form_add">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fechaadd" name="fechaadd" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="horainicio">Hora de inicio</label>
                        <select id="horainicioadd" name="horainicioadd" class="form-control select2" style="width: 100%;" required>>
                          <option value="07:00" selected>07 : 00 a.m.</option>
                          <option value="07:15">07 : 15 a.m.</option>
                          <option value="07:30">07 : 30 a.m.</option>
                          <option value="07:45">07 : 45 a.m.</option>
                          <option value="08:00">08 : 00 a.m.</option>
                          <option value="08:15">08 : 15 a.m.</option>
                          <option value="08:30">08 : 30 a.m.</option>
                          <option value="08:45">08 : 45 a.m.</option>
                          <option value="09:00">09 : 00 a.m.</option>
                          <option value="09:15">09 : 15 a.m.</option>
                          <option value="09:30">09 : 30 a.m.</option>
                          <option value="09:45">09 : 45 a.m.</option>
                          <option value="10:00">10 : 00 a.m.</option>
                          <option value="10:15">10 : 15 a.m.</option>
                          <option value="10:30">10 : 30 a.m.</option>
                          <option value="10:45">10 : 45 a.m.</option>
                          <option value="11:00">11 : 00 a.m.</option>
                          <option value="11:15">11 : 15 a.m.</option>
                          <option value="11:30">11 : 30 a.m.</option>
                          <option value="11:45">11 : 45 a.m.</option>
                          <option value="12:00">12 : 00 p.m.</option>
                          <option value="12:15">12 : 15 p.m.</option>
                          <option value="12:30">12 : 30 p.m.</option>
                          <option value="12:45">12 : 45 p.m.</option>
                          <option value="13:00">01 : 00 p.m.</option>
                          <option value="13:15">01 : 15 p.m.</option>
                          <option value="13:30">01 : 30 p.m.</option>
                          <option value="13:45">01 : 45 p.m.</option>
                          <option value="14:00">02 : 00 p.m.</option>
                          <option value="14:15">02 : 15 p.m.</option>
                          <option value="14:30">02 : 30 p.m.</option>
                          <option value="14:45">02 : 45 p.m.</option>
                          <option value="15:00">03 : 00 p.m.</option>
                          <option value="15:15">03 : 15 p.m.</option>
                          <option value="15:30">03 : 30 p.m.</option>
                          <option value="15:45">03 : 45 p.m.</option>
                          <option value="16:00">04 : 00 p.m.</option>
                          <option value="16:15">04 : 15 p.m.</option>
                          <option value="16:30">04 : 30 p.m.</option>
                          <option value="16:45">04 : 45 p.m.</option>
                          <option value="17:00">05 : 00 p.m.</option>
                          <option value="17:15">05 : 15 p.m.</option>
                          <option value="17:30">05 : 30 p.m.</option>
                          <option value="17:45">05 : 45 p.m.</option>
                          <option value="18:00">06 : 00 p.m.</option>
                          <option value="18:15">06 : 15 p.m.</option>
                          <option value="18:30">06 : 30 p.m.</option>
                          <option value="18:45">06 : 45 p.m.</option>
                          <option value="19:00">07 : 00 p.m.</option>
                          <option value="19:15">07 : 15 p.m.</option>
                          <option value="19:30">07 : 30 p.m.</option>
                          <option value="19:45">07 : 45 p.m.</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="horafinal">Hora de final</label>
                        <select id="horafinaladd" name="horafinaladd" class="form-control select2" style="width: 100%;" required>
                          <option value="07:00">07 : 00 a.m.</option>
                          <option value="07:15">07 : 15 a.m.</option>
                          <option value="07:30">07 : 30 a.m.</option>
                          <option value="07:45">07 : 45 a.m.</option>
                          <option value="08:00">08 : 00 a.m.</option>
                          <option value="08:15">08 : 15 a.m.</option>
                          <option value="08:30">08 : 30 a.m.</option>
                          <option value="08:45">08 : 45 a.m.</option>
                          <option value="09:00">09 : 00 a.m.</option>
                          <option value="09:15">09 : 15 a.m.</option>
                          <option value="09:30">09 : 30 a.m.</option>
                          <option value="09:45">09 : 45 a.m.</option>
                          <option value="10:00" selected>10 : 00 a.m.</option>
                          <option value="10:15">10 : 15 a.m.</option>
                          <option value="10:30">10 : 30 a.m.</option>
                          <option value="10:45">10 : 45 a.m.</option>
                          <option value="11:00">11 : 00 a.m.</option>
                          <option value="11:15">11 : 15 a.m.</option>
                          <option value="11:30">11 : 30 a.m.</option>
                          <option value="11:45">11 : 45 a.m.</option>
                          <option value="12:00">12 : 00 p.m.</option>
                          <option value="12:15">12 : 15 p.m.</option>
                          <option value="12:30">12 : 30 p.m.</option>
                          <option value="12:45">12 : 45 p.m.</option>
                          <option value="13:00">01 : 00 p.m.</option>
                          <option value="13:15">01 : 15 p.m.</option>
                          <option value="13:30">01 : 30 p.m.</option>
                          <option value="13:45">01 : 45 p.m.</option>
                          <option value="14:00">02 : 00 p.m.</option>
                          <option value="14:15">02 : 15 p.m.</option>
                          <option value="14:30">02 : 30 p.m.</option>
                          <option value="14:45">02 : 45 p.m.</option>
                          <option value="15:00">03 : 00 p.m.</option>
                          <option value="15:15">03 : 15 p.m.</option>
                          <option value="15:30">03 : 30 p.m.</option>
                          <option value="15:45">03 : 45 p.m.</option>
                          <option value="16:00">04 : 00 p.m.</option>
                          <option value="16:15">04 : 15 p.m.</option>
                          <option value="16:30">04 : 30 p.m.</option>
                          <option value="16:45">04 : 45 p.m.</option>
                          <option value="17:00">05 : 00 p.m.</option>
                          <option value="17:15">05 : 15 p.m.</option>
                          <option value="17:30">05 : 30 p.m.</option>
                          <option value="17:45">05 : 45 p.m.</option>
                          <option value="18:00">06 : 00 p.m.</option>
                          <option value="18:15">06 : 15 p.m.</option>
                          <option value="18:30">06 : 30 p.m.</option>
                          <option value="18:45">06 : 45 p.m.</option>
                          <option value="19:00">07 : 00 p.m.</option>
                          <option value="19:15">07 : 15 p.m.</option>
                          <option value="19:30">07 : 30 p.m.</option>
                          <option value="19:45">07 : 45 p.m.</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="materialsocializado">Tiempo Trancurrido</label>
                        <input type="text" id="horas_justificacion_real" name="horas_justificacion_real" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="profesor">Clase</label>
                        <select id="claseadd" name="claseadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione una clase </option>
                          <?php foreach ($clases as $clases) :?>
                            <option value="<?php echo removeJunk($clases['id_lessons']); ?>"><?php echo removeJunk($clases['title'] . " - " . $clases['namegroup_lessons'] . " - " . $clases['start']); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="materialsocializado">Material socializado</label>
                      <input type="text" title="Material Socializado" id="materialsocializadoadd" name="materialsocializadoadd" class="form-control" placeholder="Guías AB 2020" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ejetematico">Eje temático</label>
                      <input class="form-control" title="Eje Temático" id="ejetematicoadd" name="ejetematicoadd" type="text" placeholder="Ciencias naturales – estequiometria " required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="institucion">Departamento</label>
                        <select id="departamentoadd" name="departamentoadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un departamento </option>
                          <?php foreach ($departamentos as $departamentos) : ?>
                            <option value="<?php echo removeJunk($departamentos['id_department']); ?>"><?php echo removeJunk($departamentos['name_department']); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="institucion"> Municipio </label>
                        <select id="municipioadd" name="municipioadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un municipio </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="institucion"> Institución </label>
                        <select id="institucionadd" name="institucionadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione una institución </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="materia">Materia</label>
                        <select id="subjectadd" name="subjectadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione una opción </option>
                          <?php foreach ($subject as $subject) : ?>
                            <option value="<?php echo removeJunk($subject['id_subject']); ?>"><?php echo removeJunk($subject['name_subject']); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="number"> Numero de asistentes.</label>
                        <input class="form-control" title="Numero de estudiantes que asistieron" pattern="^[0-9]+" id="numberassistants" name="numberassistants" type="number" placeholder="35 Estudiantes" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" rows="3" id="observacionesadd" name="observacionesadd" placeholder="Observaciones..."></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Adjuntar lista de asistencia (.txt / .pdf / .jpg) </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="evidenceadd" required name="evidenceadd" onchange="return fileValidation(this.files[0].name)" />
                        <label class="custom-file-label" id="evidencelabel" name="evidencelabel" for="exampleInputFile"></label>
                      </div>
                    </div>
                    <input type="text" id="name" name="name" class="form-control" value="No se ha seleccionado un archivo" readonly>
                    <br>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success float-right">
                      <i class="fas fa-save"> Guardar asistencia </i>
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <div class="card card-primary  collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Ultimos 1000 asistencias registradas</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="card">
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Fecha</th>
                          <th>Inicio/Final</th>
                          <th>Duracion de la clase</th>
                          <th>Clase</th>
                          <th>Material socializado</th>
                          <th>Eje temático</th>
                          <th>Numero de asistentes</th>
                          <th>Opción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($asistance as $asistance) : ?>
                          <tr>
                            <td class="text-center"> <?php echo countId(); ?></td>
                            <td class="text-center"> <?php echo $asistance['date_assistance']; ?></td>
                            <td class="text-center"> <?php echo $asistance['start_time_assistance'] . " - " . $asistance['end_time_assistance']; ?></td>
                            <td class="text-center"> <?php echo $asistance['time_elapsed_assistance'] . " Hrs"; ?></td>
                            <td class="text-center" title="<?php echo $asistance['name_subject']; ?>"> <?php echo $asistance['title']; ?></td>
                            <td class="text-center"> <?php echo $asistance['socialized_material_assistance']; ?></td>
                            <td class="text-center"> <?php echo $asistance['main_theme_assistance']; ?></td>
                            <td class="text-center"> <?php echo $asistance['number_assistants'] . " Est."; ?></td>
                            <td class="text-center">
                              <a class="btn btn-success btn-sm btnVer" title="Ver Evidencia" href="javascript:window.open('evidence.php?evicencia=<?php echo $asistance['evidence_assistance'] ?>','','width=800,height=650,left=50,top=50,toolbar=yes');void 0">
                                <i class="far fa-folder-open"></i> </a>
                              <a class="btn btn-info btn-sm btnDetails" title="Ver Detalles" data-id="<?php echo $asistance['id_assistance']; ?>" data-fecha="<?php echo $asistance['date_assistance']; ?>" data-horainicio="<?php echo $asistance['start_time_assistance']; ?>" data-asignatura="<?php echo $asistance['name_subject']; ?>" data-horafinal="<?php echo $asistance['end_time_assistance']; ?>" data-tiempototal="<?php echo $asistance['time_elapsed_assistance']; ?>" data-colegio="<?php echo $asistance['name_colleges']; ?>" data-profesor="<?php echo $asistance['teacher_lessons']; ?>" data-asignatura="<?php echo $asistance['name_subject']; ?>" data-material="<?php echo $asistance['socialized_material_assistance']; ?>" data-numeroasistentes="<?php echo $asistance['number_assistants']; ?>" data-ejetematico="<?php echo $asistance['main_theme_assistance']; ?>" data-clase="<?php echo $asistance['title']; ?>" data-fechaclas="<?php echo $asistance['start']; ?>" data-evidencia="<?php echo $asistance['evidence_assistance']; ?>" data-observaciones="<?php echo $asistance['observations_assistance']; ?>" data-toggle="modal" data-target="#modal-xl">
                                <i class="far fa-eye"></i> </a>
                              <?php if ($user['tipo'] == "Administrador") { ?>
                                <a class="btn btn-primary btn-sm btnEditar" href="#">
                                  <i class="far fa-edit"></i> </a>
                                <a class="btn btn-danger btn-sm btnDelete" data-id="<?php echo $asistance['id_assistance']; ?>" data-clase="<?php echo $asistance['title']; ?>">
                                  <i class="far fa-trash-alt"></i> </a>
                              <?php } ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modal-xl">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detalles de asistencia </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card card card-light">
              <div class="card-header">
                <h3 class="card-title" id="dateDetails"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-calendar-alt"></i> Inicio / Final de clase</strong>

                <p class="text-muted" id="startendclass">

                </p>

                <hr>

                <strong><i class="fas fa-clock"></i> Duracion de la clase</strong>

                <p class="text-muted" id="durationclass"></p>

                <hr>

                <strong><i class="fas fa-chalkboard-teacher"></i> Profesor</strong>

                <p class="text-muted" id="teacherclass"></p>

                <hr>

                <strong><i class="fas fa-chalkboard-teacher"></i> Asignatura</strong>

                <p class="text-muted" id="subjetclass"></p>

                <hr>
                <strong><i class="fas fa-school"></i> Institución</strong>

                <p class="text-muted" id="collageclass"></p>

                <hr>

                <strong><i class="fas fa-file-signature"></i> Material de la clase</strong>

                <p class="text-muted" id="materialclass"></p>

                <hr>

                <strong><i class="fas fa-book-reader"></i> Eje temático </strong>

                <p class="text-muted" id="ejetematicoclass"></p>

                <hr>
                <strong><i class="fas fa-users"></i> Clase</strong>

                <p class="text-muted" id="class"></p>

                <hr>
                <strong><i class="fas fa-sort-numeric-up"></i> Numero de asistentes</strong>

                <p class="text-muted" id="numberclass"></p>

                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Notas</strong>

                <p class="text-muted" id="observationclass"></p>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <?php include('../layout/footer.php'); ?>
</body>

<script>
  $(document).ready(function() {

    $("#departamentoadd").change(function() {
      $.get("../includes/sentences/get_municipality.php", "departamentoadd=" + $("#departamentoadd").val(), function(data) {
        $("#municipioadd").html(data);
        console.log(data);
      });
    });
    $("#municipioadd").change(function() {
      $.get("../includes/sentences/get_colleges.php", "municipioadd=" + $("#municipioadd").val(), function(data) {
        $("#institucionadd").html(data);
        console.log(data);
      });
    });
  });
</script>

<script>
  $(function() {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
  $(document).ready(function() {
    $(".btnDetails").click(function() {
      var id = $(this).data('id');
      var fecha = $(this).data('fecha');
      var horainicio = $(this).data('horainicio');
      var horafinal = $(this).data('horafinal');
      var duracion = $(this).data('tiempototal');
      var profesor = $(this).data('profesor');
      var colegio = $(this).data('colegio');
      var materialsocializado = $(this).data('material');
      var ejetematico = $(this).data('ejetematico');
      var clase = $(this).data('clase');
      var fechaclas = $(this).data('fechaclas');
      var numeroasistente = $(this).data('numeroasistentes');
      var observaciones = $(this).data('observaciones');
      var numeroestudiantes = $(this).data('numeroestudiantes');
      var asignatura = $(this).data('asignatura')
      $("#dateDetails").text("  " + fecha);
      $("#startendclass").text(horainicio + " / " + horafinal);
      $("#durationclass").text(duracion + " Horas");
      $("#teacherclass").text("  " + profesor);
      $("#collageclass").text("  " + colegio);
      $("#subjetclass").text("  " + asignatura);
      $("#materialclass").text("  " + materialsocializado);
      $("#ejetematicoclass").text("  " + ejetematico);
      $("#class").text("  " + clase + " / " + fechaclas);
      $("#numberclass").text("  " + numeroasistente + " Estudiantes");
      $("#observationclass").text("  " + observaciones);
    });
    $(".btnDelete").click(function() {
      var id = $(this).data('id');
      var clase = $(this).data('clase');
      fila = $(this).parent('td').parent('tr');
      eliminar(id, clase, fila);
    });
  });
</script>

<script>
  function fileValidation($name) {
    var fileInput = document.getElementById('evidenceadd');
    var filePath = fileInput.value;
    if (fileInput.length == 0) {
      alert("Por favor seleccion un archivo");
    } else {
      var allowedExtensions = /(.jpg|.jpeg|.png|.pdf)$/i;
      if (!allowedExtensions.exec(filePath)) {
        alert('El  archivo ' + $name + ' no contiene extensiones: .jpeg / .jpg / .png / .pdf');
        fileInput.value = '';
        return false;
      } else {
        $("#name").val($name);
      }
    }
  }
</script>

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  $('.clockpicker').clockpicker();
</script>

<script>
  function calculardiferencia() {
    var hora_final = $('#horafinaladd').val();
    var hora_inicio = $('#horainicioadd').val();
    // console.log("- "+hora_inicio + hora_final);
    // Expresión regular para comprobar formato
    var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
    // Si algún valor no tiene formato correcto sale
    if (!(hora_inicio.match(formatohora) &&
        hora_final.match(formatohora))) {
      return;
    }
    // Calcula los minutos de cada hora
    var minutos_inicio = hora_inicio.split(':')
      .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
    var minutos_final = hora_final.split(':')
      .reduce((p, c) => parseInt(p) * 60 + parseInt(c));

    // Si la hora final es anterior a la hora inicial sale
    if (minutos_final < minutos_inicio) return;

    // Diferencia de minutos
    var diferencia = minutos_final - minutos_inicio;

    // Cálculo de horas y minutos de la diferencia
    var horas = Math.floor(diferencia / 60);
    var minutos = diferencia % 60;
    if (hora_final <= hora_inicio || hora_inicio >= hora_final) {
      $('#horas_justificacion_real').val("Error, Verifique...");
    } else {
      $('#horas_justificacion_real').val(horas + ':' +
        (minutos < 10 ? '0' : '') + minutos);
    }
  }

  $('#horainicioadd').change(calculardiferencia);
  $('#horafinaladd').change(calculardiferencia);
  calculardiferencia();
</script>

<script>
  function eliminar($id, $clase, $fila) {
    Swal.fire({
      title: 'Desea Eliminar esta asistencia?' + $clase,
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: `Eliminar`,
      denyButtonText: `No eliminar, cancelar`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        $.ajax({
          type: 'POST',
          url: '../includes/sentences/delete_asistences.php',
          data: {
            id: $id
          },
          success: function(msg) {
            Swal.fire('Asistencia eliminada!', '', 'success')
            $($fila).fadeOut(1000);
          },
          error: function() {
            Swal.fire('Changes are not saved', '', 'error')
          }
        });
      } else if (result.isDenied) {
        Swal.fire('Asistencia no eliminada', '', 'info')
      }
    })
  }
</script>

</html>