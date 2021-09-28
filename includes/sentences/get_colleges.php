<?php
require_once('../load.php');
$query = $db->query("select * from colleges where id_municipality= '$_GET[municipioadd]'");
$colleges = array();
while ($r = $query->fetch_object()) {
    $colleges[] = $r;
}
if (count($colleges) > 0) {
    print "<option value='' selected disabled hidden>Seleccione una opción </option>    ";
    foreach ($colleges as $colleges) {
        print "<option value='$colleges->id_colleges'>$colleges->name_colleges</option>";
    }
} else {
    print "<option value=''>-- NO HAY DATOS --</option>";
}
?>