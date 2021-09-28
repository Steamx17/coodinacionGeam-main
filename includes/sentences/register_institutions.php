<?php
include "../load.php";
if (isset($_POST['municipioadd']) && isset($_POST['nombreinstitucion'])  ) {
     $db->query("INSERT INTO colleges  VALUES(null,'" . $_POST['nombreinstitucion'] . "','" . $_POST['municipioadd'] . "'
 )")or die($db->error);
    $session->msg('s', "La institución   " . $_POST['nombreinstitucion']."  ha sido agregado correctamente.");
    redirect('../../pages/institutions.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/institutions.php', false);
}

//    $db->query("UPDATE students SET identification_students = '" . $_POST['identidaadd'] . "' , names_students = '" . $_POST['nombresadd'] . "'  WHERE id_students = '" . $_POST['id_studentedit'] . "';

?>