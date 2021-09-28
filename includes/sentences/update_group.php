<?php
include "../load.php";

if (isset($_POST['Codgrupo']) && isset($_POST['nombregrupo']) && isset($_POST['gradogrupo']) && isset($_POST['municipioadd']) && isset($_POST['observacionesgrupo'])) {
    $db->query("UPDATE  troop SET  cod_group ='" . $_POST['Codgrupo'] . "',
    name_group =  '" . $_POST['nombregrupo'] . "',
    grade_group= '" . $_POST['gradogrupo'] . "',
    observation_group= '" . $_POST['observacionesgrupo'] . "',
    id_municipality = '" . $_POST['municipioadd'] . "' WHERE id_group = '" . $_POST['idParaEditar'] . "';") or die($db->error);


    $session->msg('s', "Grupo editado correctamente.");
    redirect('../../pages/group.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/group.php', false);
}
