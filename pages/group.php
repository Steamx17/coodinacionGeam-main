<?php /* 
<section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <?php echo displayMSG($msg); ?>
              <div class="card-header">
                <h3 class="card-title">Registrar Grupo</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form action="../includes/sentences/register_group.php" method="POST">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputProjectLeader">Identificador del grupo</label>
                        <input type="text" id="idgrupo" name="idgrupo" value="<?php echo "G-" . date('is') . generarCodigo(6) ?>" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="inputProjectLeader">Nombre del grupo </label>
                        <input type="text" id="nombregrupo" name="nombregrupo" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                      </div>
                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institucion"> Municipio </label>
                        <select id="municipioadd" name="municipioadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un municipio </option>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institucion">Nombre de la institución</label>
                        <select id="departamentoadd" name="departamentoadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un departamento </option>
                          <?php foreach ($departamentos as $departamentos) : ?>
                            <option value="<?php echo removeJunk($departamentos['id_department']); ?>"><?php echo removeJunk($departamentos['name_department']); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputStatus">Grado</label>
                        <select id="gradogrupo" name="gradogrupo" class="form-control select2" required>
                          <option value="" selected disabled hidden>Seleccione una opción</option>
                          <option value="9">9º</option>
                          <option value="10">10º</option>
                          <option value="11">11º</option>
                        </select>
                      </div>
                    </div>


                  </div>
                  <div class="form-group">
                    <label for="inputProjectLeader">Observaciones</label>
                    <textarea class="form-control" id="observacionesgrupo" name="observacionesgrupo" rows="3" placeholder="Observaciones..."></textarea>
                  </div>

                  <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success float-right">
                      <i class="fas fa-save"> Guardar Grupo</i>
                    </button>
                  </div>


                </form>
              </div>
 */ ?>




<?php include_once('../includes/load.php');
$user = current_user();
if (!$session->isUserLoggedIn(true)) {
  redirect('../index', false);
}
if ($user['tipo'] == "Docente") {
  redirect('./lessonsTeachers', false);
}
$group = findAllgroup();
$departamentos = findAllDepartaments();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Institución | GEAM</title>
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
                <li class="breadcrumb-item active">Institución</li>
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
                <h3 class="card-title">Registrar Grupo</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>

              <div class="card-body">
                <form action="../includes/sentences/register_group.php" method="POST">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputProjectLeader">Identificador del grupo</label>
                        <input type="text" id="idgrupo" name="idgrupo" value="<?php echo "G-" . date('is') . generarCodigo(6) ?>" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="inputProjectLeader">Nombre del grupo </label>
                        <input type="text" id="nombregrupo" name="nombregrupo" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <select id="departamentoadd" name="departamentoadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un departamento </option>
                          <?php foreach ($departamentos as $departamentos) : ?>
                            <option value="<?php echo removeJunk($departamentos['id_department']); ?>"><?php echo removeJunk($departamentos['name_department']); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institucion"> Municipio </label>
                        <select id="municipioadd" name="municipioadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un municipio </option>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="inputStatus">Grado</label>
                        <select id="gradogrupo" name="gradogrupo" class="form-control select2" required>
                          <option value="" selected disabled hidden>Seleccione una opción</option>
                          <option value="9">9º</option>
                          <option value="10">10º</option>
                          <option value="11">11º</option>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                    <label for="inputProjectLeader">Observaciones</label>
                    <textarea class="form-control" id="observacionesgrupo" name="observacionesgrupo" rows="3" placeholder="Observaciones..."></textarea>
                  </div>



                  <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success float-right">
                      <i class="fas fa-save"> Guardar</i>
                    </button>
                  </div>


                </form>
              </div>

              <!-- /.card-body -->
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Grupos existentes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <table id="example1" class="table table-bordered table-striped">-->
                <table id="example1" class="table table-bordered table-hover projects text-center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Codigo del grupo</th>
                      <th>Nombre</th>
                      <th>Departament / Municipio</th>
                      <th>Grado</th>
                      <th>Editar</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($group as $group) : ?>
                      <tr>
                        <td class="text-center"><?php echo countId(); ?></td>
                        <td class="text-center"> <?php echo removeJunk($group['cod_group']); ?></td>
                        <td class="text-center"> <?php echo removeJunk($group['name_group']); ?></td>
                        <td class="text-center"> <?php echo removeJunk($group['name_department']) . " / " . removeJunk($group['name_municipality']); ?></td>
                        <td class="text-center"> <?php echo removeJunk($group['grade_group']) . "º"; ?></td>
                        <td class="text-center">
                          <button title="Editar" class="btn btn-primary btn-sm btnEditar" data-id_group="<?php echo $group['id_group']; ?>" data-id_colleges="<?php echo $group['id_municipality']; ?>" data-cod_group="<?php echo $group['cod_group']; ?>" data-name_group="<?php echo $group['name_group']; ?>" data-name_colleges="<?php echo $group['name_municipality']; ?>" data-observation_group="<?php echo $group['observation_group']; ?>" data-grade_group=" <?php echo $group['grade_group']; ?> " data-toggle="modal" data-target="#modalEditar">
                            <i class="fas fa-edit"></i> </button>
                        </td>

                      </tr>
                    <?php endforeach; ?>


                    </tfoot>
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
    <!-- Ventana Modal -->

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
              <?php // echo displayMSG($msg); 
              ?>
              <div class="card-header">
                <h3 class="card-title">Editar Grupo</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>

              <div class="card-body">
                <form action="../includes/sentences/update_group.php" method="POST">
                  <input type="hidden" id="idParaEditar" name="idParaEditar" required>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputProjectLeader">Identificador del grupo</label>
                        <input type="text" id="Codgrupox" name="Codgrupo" value="" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="inputProjectLeader">Nombre del grupo </label>
                        <input type="text" id="nombregrupox" name="nombregrupo" value="" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                      </div>
                    </div>

                  </div>

                  <?php $departamentos = findAllDepartaments();
                  //groupById($id_group);

                  ?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <select id="departamentoaddx" name="departamentoadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un departamento </option>
                          <?php foreach ($departamentos as $departamentos) : ?>
                            <option value="<?php echo removeJunk($departamentos['id_department']); ?>"><?php echo removeJunk($departamentos['name_department']); ?></option>
                          <?php endforeach; ?>

                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institucion"> Municipio </label>
                        <select id="municipioaddx" name="municipioadd" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled hidden>Seleccione un municipio </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">


                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="inputStatus">Grado</label>
                        <select id="gradogrupox" name="gradogrupo" class="form-control select2" required>
                          <option value="" selected disabled hidden>Seleccione una opción</option>



                          <option value="9">9º <?php  ?> </option>
                          <option value="10">10º</option>
                          <option value="11">11º</option>



                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                    <label for="inputProjectLeader">Observaciones</label>
                    <textarea class="form-control" id="observacionesgrupox" name="observacionesgrupo" value="" rows="3" placeholder="Observaciones..."></textarea>
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

    $("#departamentoaddx").change(function() {
      $.get("../includes/sentences/get_municipality.php?bandera2=2", "departamentoaddx=" + $("#departamentoaddx").val(), function(data) {
        $("#municipioaddx").html(data);
      });
    });

  });
</script>





<script>
  $(document).ready(function() {

    $("#departamentoadd").change(function() {
      $.get("../includes/sentences/get_municipality.php?bandera1=1", "departamentoadd=" + $("#departamentoadd").val(), function(data) {
        $("#municipioadd").html(data);
      });
    });

  });
</script>



<script>
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
    //Confirmar

    $(".btnEditar").click(function() {
      // $("#formGrop").trigger("reset");
      var id_group = $(this).data('id_group');
      var cod_group = $(this).data('cod_group');
      var name_group = $(this).data('name_group');
      var name_colleges = $(this).data('name_colleges');
      var grade_group = $(this).data('grade_group');
      var observation_group = $(this).data('observation_group');


      $("#idParaEditar").val(id_group);
      $("#Codgrupox").val(cod_group);
      $("#nombregrupox").val(name_group);
      $("#gradogrupo").val(grade_group);
      $("#observacionesgrupox").val(observation_group);
      // $(document).ready(function() {

      $("#modalEditar").change(function() {
        $.get("../includes/sentences/get_municipality.php", "departamentoadd=" + $("#departamentoadd").val(), "idParaEditarx=" + $("#idParaEditar").val(id_group), function(data) {
          $("#municipioaddx").html(data);

        });
      });


      $("#departamentoaddx").change(function() {
        $.get("../includes/sentences/get_municipality.php", "departamentoadd=" + $("#departamentoadd").val(), "idParaEditarx=" + $("#idParaEditar").val(id_group), function(data) {
          $("#municipioaddx").html(data);

        });
      });

      //});

      <?php
      $Id_PHP = "document.writeln(id_group);"; // igualar el valor de la variable JavaScript a PHP 

      if ($Id_PHP != null) {
        // echo  $Id_PHP;
        $loco  = findGroup($Id_PHP);
      }
      ?>

    });

  });

  /*$("#formGrop").submit(function(e) {
    e.preventDefault();

    id_group = $.trim($("#id_group").val());

    $.ajax({
      url: "../includes/sentences/prueba.php",
      type: "POST",
      dataType: "json",
      data: {
        id_group: id_group
      },
      success: function(data) {
        console.log(data);
        id_group = data[0].id_group;

      }
    });
    // $("#modalCRUD").modal("hide");    

  });

*/



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