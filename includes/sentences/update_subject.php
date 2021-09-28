<?php
include "../load.php";

if (isset($_POST['idsubjecteditar']) && isset($_POST['nombreasignaturaditar']) && isset($_POST['observacionesasignaturaditar'])) {
    $db->query("UPDATE subject SET  name_subject ='" . $_POST['nombreasignaturaditar'] . "',
  
      WHERE id_subject = '" . $_POST['idsubjecteditar'] . "';") or die($db->error);
    $session->msg('s', "Asignatura actualizada correctamente.");
    redirect('../../pages/subject', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/subject', false);
}
