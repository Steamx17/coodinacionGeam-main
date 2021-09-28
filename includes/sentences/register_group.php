<?php
include "../load.php";
if (isset($_POST['idgrupo']) && isset($_POST['nombregrupo']) && isset($_POST['gradogrupo']) && isset($_POST['municipioadd']) && isset($_POST['observacionesgrupo'])) {
     $db->query("INSERT INTO troop  VALUES(null,'" . $_POST['idgrupo'] . "','" . $_POST['nombregrupo'] . "','" . $_POST['gradogrupo'] . "','" . $_POST['observacionesgrupo'] . "','" . $_POST['municipioadd'] . "'
 )")or die($db->error);
    $session->msg('s', "Grupo agregado correctamente.");
    redirect('../../pages/group.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/group.php', false);
}
