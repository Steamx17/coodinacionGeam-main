<?php
include "../load.php";
if (isset($_POST['tipomovimiento']) && isset($_POST['date']) && isset($_POST['concepto']) && isset($_POST['recibocaja']) && isset($_POST['valor']) && isset($_POST['detalles']) && isset($_POST['docidentidad'])) {
    $cadena = $_POST['date'];
    $array = explode("-", $cadena);
    $p_mes = $array[1];
    $p_dia = $array[2];
    $p_año = $array[0];
    $db->query("INSERT INTO box  VALUES(null,'" . $_POST['date'] . "','" . $_POST['concepto'] . "','" . $_POST['docidentidad'] . "','" . $_POST['recibocaja'] . "','" . $_POST['tipomovimiento'] . "','" . $_POST['valor'] . "','" . $_POST['detalles'] . "','" . $p_dia . "','" . $p_mes . "','" . $p_año . "'
 )")or die($db->error);
    $session->msg('s', "Movimiento agregado existosamente. ");
    redirect('../../box.php', false);
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../box.php', false);
}
?>

