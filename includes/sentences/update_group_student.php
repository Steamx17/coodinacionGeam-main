<?php
include "../load.php";
if ( isset($_POST['id_studentgroup'])  && isset($_POST['grupoedit']) ) {
     $db->query("UPDATE students SET group_students = '" . $_POST['grupoedit'] . "' WHERE id_students = '" . $_POST['id_studentgroup'] . "';
 ")or die($db->error);
    $session->msg('s', "El grupo  ha sido actualizado correctamente.");
    redirect('../../pages/students.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/students.php', false);
}
?>