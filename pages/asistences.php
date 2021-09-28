<?php include_once('../includes/load.php');
$user = current_user();
if (!$session->isUserLoggedIn(true)) {
    redirect('../index', false);
}
if ($user['tipo'] == "Docente") {
    redirect('./lessonsTeachers', false);
}
$asistance = findAllasistance();
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
                        <div class="card card-primary  collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Todas las asistencias</h3>
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
                                                        <td class="text-center"> <?php echo $asistance['title']; ?></td>
                                                        <td class="text-center"> <?php echo $asistance['socialized_material_assistance']; ?></td>
                                                        <td class="text-center"> <?php echo $asistance['main_theme_assistance']; ?></td>
                                                        <td class="text-center"> <?php echo $asistance['number_assistants'] . " Est."; ?></td>
                                                        <td class="text-center">
                                                            <a class="btn btn-success btn-sm btnVer" title="Ver Evidencia" href="javascript:window.open('evidence.php?evicencia=<?php echo $asistance['evidence_assistance'] ?>','','width=800,height=650,left=50,top=50,toolbar=yes');void 0">
                                                                <i class="far fa-folder-open"></i> </a>
                                                            <a class="btn btn-info btn-sm btnDetails" title="Ver Detalles" data-id="<?php echo $asistance['id_assistance']; ?>" data-fecha="<?php echo $asistance['date_assistance']; ?>" data-horainicio="<?php echo $asistance['start_time_assistance']; ?>" data-horafinal="<?php echo $asistance['end_time_assistance']; ?>" data-asignatura="<?php echo $asistance['name_subject']; ?>" data-tiempototal="<?php echo $asistance['time_elapsed_assistance']; ?>" data-colegio="<?php echo $asistance['name_colleges']; ?>" data-profesor="<?php echo $asistance['teacher_lessons']; ?>" data-asignatura="<?php echo $asistance['name_subject']; ?>" data-material="<?php echo $asistance['socialized_material_assistance']; ?>" data-numeroasistentes="<?php echo $asistance['number_assistants']; ?>" data-ejetematico="<?php echo $asistance['main_theme_assistance']; ?>" data-clase="<?php echo $asistance['namegroup_lessons']; ?>" data-fechaclas="<?php echo $asistance['start']; ?>" data-evidencia="<?php echo $asistance['evidence_assistance']; ?>" data-observaciones="<?php echo $asistance['observations_assistance']; ?>" data-toggle="modal" data-target="#modal-xl">
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

        <?php include('../layout/footer.php'); ?>
</body>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<script>
    $(document).ready(function() {
        //Confirmar
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