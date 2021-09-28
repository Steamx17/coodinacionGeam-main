<?php
include "../load.php";
if (isset($_POST['identidaadd']) && isset($_POST['nombresadd'])  ) {
     $db->query("INSERT INTO students  VALUES(null,'" . $_POST['identidaadd'] . "','" . $_POST['nombresadd'] . "','" . $_POST['grupoadd'] . "'
 )")or die($db->error);
    $session->msg('s', "El estudiante " . $_POST['nombresadd']."  ha sido agregado correctamente.");
    redirect('../../pages/students.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/students.php', false);
}

//    $db->query("UPDATE students SET identification_students = '" . $_POST['identidaadd'] . "' , names_students = '" . $_POST['nombresadd'] . "'  WHERE id_students = '" . $_POST['id_studentedit'] . "';

?>