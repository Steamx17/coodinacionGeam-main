<?php
include_once('../load.php');
$db->query("DELETE FROM assistance WHERE id_assistance=" . $_POST['id']);
echo "eliminado";
?>