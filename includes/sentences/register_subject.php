<?php
include "../load.php";
if (isset($_POST['nombreasignatura']) && isset($_POST['observacionesasignatura'])) {
     $db->query("INSERT INTO subject  VALUES(null,'" . $_POST['nombreasignatura'] . "','" . $_POST['observacionesasignatura'] . "'
 )")or die($db->error);
    $session->msg('s', " Asignatura  agregado correctamente. ");
    redirect('../../pages/subject', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/subject', false);
}
?>