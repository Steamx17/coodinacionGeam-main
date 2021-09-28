<?php
include "../load.php";
if (isset($_POST['nombredocente']) && isset($_POST['apellidodocente']) && isset($_POST['nombrecompleto']) && isset($_POST['asignaturedocente']) && isset($_POST['statusdocente'])&& isset($_POST['observacionesdocente'])) {
     $db->query("INSERT INTO teacher  VALUES(null,'" .removeJunk($_POST['nombredocente']) . "','" . removeJunk($_POST['apellidodocente']) . "','" . removeJunk($_POST['nombrecompleto']) . "','" . removeJunk($_POST['asignaturedocente']) . "','" . removeJunk($_POST['statusdocente']) . "','" . removeJunk($_POST['observacionesdocente']) . "'
 )")or die($db->error);
    $session->msg('s', "Docente agregado correctamente.");
    redirect('../../pages/teachers.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/teachers.php', false);
}
?>