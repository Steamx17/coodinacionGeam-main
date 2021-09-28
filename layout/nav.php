    <?php
    include_once('../includes/load.php');
    if (!$session->isUserLoggedIn(true)) {
        redirect('../index.php', false);
    }
    $user = current_user();
    $numeroGrupo = countGroup();
    $numeroAsistencia = countAsistence();
    $numeroGrupo = countGroup();
    $allGroup = findAllgroup();
    $numeroClases = countClass();
    ?>
    <!-- Preloader 
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="../assets/dist/img/LOGO.png" alt="AdminLTELogo" height="60" width="60">
        <p>Cargando...</p> -->
    </div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" data-toggle="modal" data-target="#exampleModal" class="nav-link"><?php echo  "Usted es: " . removeJunk(ucfirst($user['name'])); ?></a>
            </li>
            <!-- <li class="nav-item dropdown">
          <div class="date">
            <span id="weekDay" class="weekDay"></span>,
            <span id="day" class="day"></span> de
            <span id="month" class="month"></span> del
            <span id="year" class="year"></span>
          </div>
          <div class="clock">
            <span id="hours" class="hours"></span> :
            <span id="minutes" class="minutes"></span> :
            <span id="seconds" class="seconds"></span>
          </div>
        </li>-->
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="../assets/dist/img/abelmendoza.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SGA-GEAM</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../assets/dist/img/abelmendozaC.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="d-block"><?php echo $user['tipo']; ?></a>
                </div>
            </div>
            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <div id="id_div">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if ($user['tipo'] == "Docente") {
                        ?>
                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Gestión Docente
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="../pages/lessonsTeachers" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Mis clases</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="../pages/dashboard" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Gestión coordinación
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="../pages/add" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Agregar asistencia</p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/asistences" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Asistencias</p>
                                            <span class="badge badge-info right asitencias"><?php echo $numeroAsistencia['total']; ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/lessonsEdit" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Clases</p>
                                            <span class="badge badge-light right"><?php echo  $numeroClases['total']; ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/teachers" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Profesores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/subject" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Asignatura</p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/institutions" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Instituciones</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-object-group"></i>
                                    <p>
                                        Gestión estudiantes/grupos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../pages/group" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Grupos</p>
                                            <span class="badge badge-info right"><?php echo $numeroGrupo['total']; ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/students" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Estudiantes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                    <p>
                                        Grupos Creados
                                        <i class="right fas fa-angle-left"></i>
                                        <span class="badge badge-primary right"><?php echo  $numeroGrupo['total']; ?></span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php foreach ($allGroup  as $allGroup) :

                                        $cont = countStudentsGroup($allGroup['id_group']);
                                    ?>
                                        <li class="nav-item">
                                            <a href="../pages/groupdetails.php?id_group=<?php echo $allGroup['id_group'] ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p><?php echo  $allGroup['name_group']; ?></p>
                                                <span class="badge badge-info right"><?php echo $cont['total']; ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="nav-header">Opciones de usuario.</li>
                        <li class="nav-item">
                            <a href="../includes/sentences/logout" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Cerrar sesión</p>
                            </a>
                        </li>

                    </ul>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Opciones de perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="../assets/dist/img/abelmendoza.jpg" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?php echo  $user['name']; ?></h3>

                            <p class="text-muted text-center"><?php echo  $user['tipo']; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Usuario</b> <a class="float-right"><?php echo  $user['iduser']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Oficina</b> <a class="float-right"><?php echo  $user['campus']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Ultimo inicio de sesión </b> <a class="float-right"><?php echo  $user['last_login']; ?></a>
                                </li>
                            </ul>

                            <a href="../includes/sentences/logout.php" class="btn btn-primary btn-block"><b>Cerrar
                                    sesión</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <script>
        /*var udateTime = function() {
        let currentDate = new Date(),
          hours = currentDate.getHours(),
          minutes = currentDate.getMinutes(),
          seconds = currentDate.getSeconds(),
          weekDay = currentDate.getDay(),
          day = currentDate.getDay(),
          month = currentDate.getMonth(),
          year = currentDate.getFullYear();

        const weekDays = [
          'Domingo',
          'Lunes',
          'Martes',
          'Miércoles',
          'Jueves',
          'Viernes',
          'Sabado'
        ];

        document.getElementById('weekDay').textContent = weekDays[weekDay];
        document.getElementById('day').textContent = day;

        const months = [
          'Enero',
          'Febrero',
          'Marzo',
          'Abril',
          'Mayo',
          'Junio',
          'Julio',
          'Agosto',
          'Septiembre',
          'Octubre',
          'Noviembre',
          'Diciembre'
        ];

        document.getElementById('month').textContent = months[month];
        document.getElementById('year').textContent = year;

        document.getElementById('hours').textContent = hours;

        if (minutes < 10) {
          minutes = "0" + minutes
        }

        if (seconds < 10) {
          seconds = "0" + seconds
        }

        document.getElementById('minutes').textContent = minutes;
        document.getElementById('seconds').textContent = seconds;
      };

      udateTime();

      setInterval(udateTime, 1000);*/
    </script>