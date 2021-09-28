<?php include_once('../includes/load.php');
   $user = current_user();
   if (!$session->isUserLoggedIn(true)) {
       redirect('../index', false);
   }
   if($user['tipo']=="Docente"){
       redirect('./lessonsTeachers', false);
   }
$students = findAllstudents();
$group = findAllgroup();
$groupEdit = findAllgroup();
$groupAdd = findAllgroup();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estudiantes | GEAM</title>
    <link rel="icon" href="../assets/dist/img/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
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
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Estudiantes</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo displayMSG($msg); ?>


                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Todos los estudiantes</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Lista de estudiantes</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                    <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Documento de identidad</th>
                                                    <th>Nombres</th>
                                                    <th>Grupo</th>
                                                    <th>Editar</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($students as $students) : ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo countId(); ?></td>
                                                        <td class="text-center"> <?php echo removeJunk($students['identification_students']); ?></td>
                                                        <td class="text-center"> <?php echo removeJunk($students['names_students']); ?></td>
                                                        <td class="text-center"> <?php echo removeJunk($students['name_group']); ?></td>
                                                        <td class="text-center">
                                                            <button title="Editar" class="btn btn-info btn-small  btnEditar" data-id="<?php echo $students['id_students']; ?>" data-identification="<?php echo $students['identification_students']; ?>" data-names="<?php echo $students['names_students']; ?>" data-group="<?php echo $students['name_group']; ?>" data-toggle="modal" data-target="#modalEditar">
                                                                <i class="fas fa-edit"></i> </button>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <!-- <tfoot>
                    <tr>
                      <th>Rendering engine</th>
                      <th>Browser</th>
                      <th>Platform(s)</th>
                      <th>Engine version</th>
                    </tr>
                  </tfoot>-->
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>

                            <!-- /.card-body -->
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Registrar Estudiante</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="../includes/sentences/register_student.php" method="POST" enctype="multipart/form-data">
                                
                                    <div class="form-group">
                                        <label for="fecha">Documento de identidad</label>
                                        <input type="number" id="identidaadd" name="identidaadd" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha">Nombres y Apellidos</label>
                                        <input type="text" id="nombresadd" name="nombresadd" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="grupo">Grupo</label>
                                                <select id="grupoadd" name="grupoadd" class="form-control select2" required>
                                                    <option value="" selected disabled hidden>Choose here</option>
                                                    <?php foreach ($groupAdd as $groupAdd) :
                                                    ?>
                                                        <option value="<?php echo removeJunk($groupAdd['id_group']);
                                                                        ?>"><?php echo removeJunk($groupAdd['name_group']). " - ". removeJunk($groupAdd['grade_group']."º");
                                                                            ?></option>
                                                    <?php endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input value="Guardar" type="submit" class="btn btn-success float-right">
                                    </div>
                                </form>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>

            </section>
        </div>
        <!-- /.content-wrapper -->




        <div class="modal fade" id="modalEditar">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Estudiante</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Editar estudiante</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="../includes/sentences/update_student.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="id_studentedit" name="id_studentedit">
                                    <div class="form-group">
                                        <label for="fecha">Identificación </label>
                                        <input type="number" id="identificacionedit" name="identificacionedit" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institucion"> Nombre y Apellido </label>
                                                <input type="text" id="nombresedit" name="nombresedit" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institucion"> Grupo </label>
                                                <input type="text" id="grupoeditver" name="grupoeditver" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="grupo">Grupo</label>
                                                <select id="grupoedit" name="grupoedit" class="form-control select2" required>
                                                <option value="" selected disabled hidden>Choose here</option>
                                                    <?php //foreach ($groupEdit as $groupEdit) : 
                                                    ?>
                                                        <option value="<?php //echo removeJunk($groupEdit['id_group']); 
                                                                        ?>"><?php //echo removeJunk($groupEdit['name_group']); 
                                                                            ?></option>
                                                    <?php //endforeach; 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="form-group">
                                        <input value="Actualizar Datos" type="submit" class="btn btn-success float-right">
                                    </div>
                                </form>
                            </div>

                            <!-- /.card-body -->
                        </div>

                        <div class="card card-primary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Editar grupo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="../includes/sentences/update_group_student.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="id_studentgroup" name="id_studentgroup">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="grupo">Grupo</label>
                                                <select id="grupoedit" name="grupoedit" class="form-control select2" required>
                                                    <option value="" selected disabled hidden>Choose here</option>
                                                    <?php foreach ($groupEdit as $groupEdit) :
                                                    ?>
                                                        <option value="<?php echo removeJunk($groupEdit['id_group']);
                                                                        ?>"><?php echo removeJunk($groupEdit['name_group']);
                                                                            ?></option>
                                                    <?php endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input value="Actualizar Grupo" type="submit" class="btn btn-success float-right">
                                    </div>
                                </form>
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
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
    $(document).ready(function() {
        //Confirmar
        $(".btnEditar").click(function() {
            var identificacion = $(this).data('identification');
            var nombres = $(this).data('names');
            var grupo = $(this).data('group');
            var idEdit = $(this).data('id');
            var idEditGroup = $(this).data('id');
            $("#identificacionedit").val(identificacion);
            $("#nombresedit").val(nombres);
            $("#grupoeditver").val(grupo);
            $("#id_studentedit").val(idEdit);
            $("#id_studentgroup").val(idEditGroup);
        });
    });
</script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
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



</html>