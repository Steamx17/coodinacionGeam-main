<?php include_once('../includes/load.php');
   $user = current_user();
   if (!$session->isUserLoggedIn(true)) {
       redirect('../index', false);
   }
   if($user['tipo']=="Docente"){
       redirect('./lessonsTeachers', false);
   }
$numeroAsistencia = countAsistence();
$numeroProfesores = countTeacher();
$numeroGrupo = countGroup();
$asistance = findAllasistanceLimit();
$numeroInstituciones = countInstitutions();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | GEAM</title>
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
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <section class="content">
                <?php echo displayMSG($msg); ?>
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $numeroAsistencia['total']; ?></h3>
                                    <p>Asistencias registradas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <a href="add" class="small-box-footer">Ir a asistencia <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $numeroProfesores['total']; ?></h3>
                                    <p>Profesores registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <a href="teachers" class="small-box-footer">Ir a profesores <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?php echo $numeroGrupo['total']; ?></h3>
                                    <p>Grupos registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="group" class="small-box-footer">Ir a grupos <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-lightblue">
                                <div class="inner">
                                    <h3><?php echo $numeroInstituciones['total']; ?></h3>
                                    <p>Colegios registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <a href="institutions" class="small-box-footer">Ir a colegios <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">
                            <div class="col-12">

                                <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Inicio/Final</th>
                                                <th>Duracion de la clase</th>
                                                <th>Clase</th>
                                                <!-- <th>Asignatura</th>-->
                                                <th>Material socializado</th>
                                                <th>Eje temático</th>
                                                <!--  <th>Institución</th>-->

                                                <th>Numero de asistentes</th>
                                                <th>Opción</th>
                                                <!--<th>Opciones</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($asistance as $asistance) : ?>
                                                <tr>
                                                    <td class="text-center"><?php echo countId(); ?></td>
                                                    <td class="text-center"> <?php echo removeJunk($asistance['date_assistance']); ?></td>
                                                    <td class="text-center"> <?php echo removeJunk($asistance['start_time_assistance']) . " - " . removeJunk($asistance['end_time_assistance']); ?></td>
                                                    <td class="text-center"> <?php echo removeJunk($asistance['time_elapsed_assistance']) . " Hrs"; ?></td>
                                                    <td class="text-center"> <?php echo removeJunk($asistance['title']); ?></td>
                                                    <td class="text-center"> <?php echo removeJunk($asistance['socialized_material_assistance']); ?></td>
                                                    <td class="text-center"> <?php echo removeJunk($asistance['main_theme_assistance']); ?></td>
                                                    <td class="text-center"> <?php echo removeJunk($asistance['number_assistants']) . " Est."; ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-primary btn-sm btnVer" title="Ver Evidencia" href="javascript:window.open('evidence.php?evicencia=<?php echo $asistance['evidence_assistance'] ?>','','width=900,height=800,left=10,top=10,toolbar=yes');void 0">
                                                            <i class="far fa-folder-open"></i> </a>
                                                    </td>                                        
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
    
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <?php include('../layout/footer.php'); ?>
</body>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>


<script src="../assets/dist/js/pages/dashboard.js"></script>



</html>