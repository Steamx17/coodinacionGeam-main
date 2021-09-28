<?php include_once('../includes/load.php');
   $user = current_user();
   if (!$session->isUserLoggedIn(true)) {
       redirect('../index', false);
   }
   if($user['tipo']=="Docente"){
       redirect('./lessonsTeachers', false);
   }

$subject = findAllsubject();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asignaturas | GEAM</title>
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
                                <li class="breadcrumb-item active">Asignaturas</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>


            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <?php echo displayMSG($msg); ?>
                            <div class="card-header">
                                <h3 class="card-title">Registrar Asignatura</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="../includes/sentences/register_subject.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombrea">Nombre de asignatura</label>
                                                <input type="text" id="nombreasignatura" name="nombreasignatura" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="observacionesasignatura">Observaciones</label>
                                        <textarea class="form-control" id="observacionesasignatura" name="observacionesasignatura" rows="3" placeholder="Observaciones..." onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-success float-right" >
                    <i class="fas fa-save"> Guardar</i>
                  </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Asignatura</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombres</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($subject as $subject) : ?>
                                            <tr>
                                                <td class="text-center"><?php echo countId(); ?></td>
                                                <td class="text-center"> <?php echo removeJunk($subject['name_subject']); ?></td>
                                                <td class="text-center">
                                                    <button title="Editar" class="btn btn-info btn-sm btnEditar" data-id="<?php echo $subject['id_subject']; ?>" data-nombre="<?php echo $subject['name_subject']; ?>" data-observaciones="<?php echo $subject['observations_subject']; ?>" data-toggle="modal" data-target="#modalEditar">
                                                        <i class="far fa-edit"></i> </button>
                                                    <!-- <button title="Eliminar" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo $teachers['id_teacher']; ?>" data-nombres="<?php echo $teachers['names_teacher']; ?>" data-nombrecompleto="<?php echo $teachers['surnames_teacher']; ?>" data-asiganatura="<?php echo $teachers['name_subject']; ?>" data-toggle="modal" data-target="#modalEliminar">
                            <i class="far fa-trash-alt"></i> </button>-->
                                                </td>
                                            </tr>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>

            </section>


        </div>
        <!-- /.content-wrapper -->

        <!-- /.content-wrapper -->
        <div class="modal fade" id="modalEditar">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <?php echo displayMSG($msg); ?>
                            <div class="card-header">
                                <h3 class="card-title">Editar Asignatura</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="../includes/sentences/update_subject.php" method="POST">
                                    <input type="hidden" id="idsubjecteditar" name="idsubjecteditar" required>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombrea">Nombre de asignatura</label>
                                                <input type="text" id="nombreasignaturaditar" name="nombreasignaturaditar" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="observacionesasignatura">Observaciones</label>
                                        <textarea class="form-control" id="observacionesasignaturaditar" name="observacionesasignaturaditar" rows="3" placeholder="Observaciones..." onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success float-right">
                                            <i class="fas fa-save"> Actualizar</i>
                                        </button>
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
    $(document).ready(function() {
        var idEliminar = -1;
        var idEditar = -1;
        var fila;
        $(".btnEliminar").click(function() {
            idEliminar = $(this).data('id');
            fila = $(this).parent('td').parent('tr');

            var nombres = $(this).data('nombres');
            var apellidos = $(this).data('apellidos');
            var asignatura = $(this).data('asiganatura');
            var observaciones = $(this).data('observaciones');

        });

        $(".eliminar").click(function() {
            $.ajax({
                url: '../includes/sqlinsert/delete_product.php',
                method: 'POST',
                data: {
                    id: idEliminar
                }
            }).done(function(res) {

                $(fila).fadeOut(1000);
            });

        });

        //Editar
        $(".btnEditar").click(function() {

            idEditarAsignatura = $(this).data('id');
            var nombre = $(this).data('nombre');
            var observaciones = $(this).data('observaciones');
            $("#idsubjecteditar").val(idEditarAsignatura);
            $("#nombreasignaturaditar").val(nombre);
            $("#observacionesasignaturaditar").val(apellidos);


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