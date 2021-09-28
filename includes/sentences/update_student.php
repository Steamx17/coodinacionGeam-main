<?php
include "../load.php";
if (  isset($_POST['id_studentedit']) && isset($_POST['identificacionedit']) && isset($_POST['nombresedit'])  ) {
    $db->query("UPDATE students SET identification_students = '" . $_POST['identificacionedit'] . "' , names_students = '" . $_POST['nombresedit'] . "'  WHERE id_students = '" . $_POST['id_studentedit'] . "';
    ")or die($db->error);
    $session->msg('s', "El estudiante " . $_POST['nombresedit']."  ha sido actualizado correctamente.");
    redirect('../../pages/students.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/students.php', false);
}

//    $db->query("UPDATE students SET identification_students = '" . $_POST['identidaadd'] . "' , names_students = '" . $_POST['nombresadd'] . "'  WHERE id_students = '" . $_POST['id_studentedit'] . "';
