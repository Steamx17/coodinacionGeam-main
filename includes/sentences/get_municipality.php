<?php
if ($_GET["bandera1"] == 1) {
    require_once('../load.php');
    $query = $db->query("select * from municipality where id_department= '$_GET[departamentoadd]'");

    $municipality = array();
    while ($r = $query->fetch_object()) {
        $municipality[] = $r;
    }
    if (count($municipality) > 0) {
        print "<option value='' selected disabled hidden>Seleccione una opción </option>    ";

        foreach ($municipality as $municipality) {
            print "<option value='$municipality->id_municipality'>$municipality->name_municipality</option>";
        }
    } else {
        print "<option value=''>-- NO HAY DATOS --</option>";
    }
}
?>

<?php

if ($_GET["bandera2"] == 2) {
    require_once('../load.php');
    $query = $db->query("select * from municipality where id_department= '$_GET[departamentoaddx]'");
    $municipality = array();
    while ($r = $query->fetch_object()) {
        $municipality[] = $r;
    }
    if (count($municipality) > 0) {
        print "<option value='' selected disabled hidden>Seleccione una opción </option>    ";
        foreach ($municipality as $municipality) {
            print "<option value='$municipality->id_municipality'>$municipality->name_municipality</option>";
        }
    } else {
        print "<option value=''>-- NO HAY DATOS --</option>";
    }
}




    require_once('../load.php');

    
    $query = $db->query("select * from municipality where id_department= '$_GET[departamentoaddx]'");
    $query2 = $db->query("select * from municipality where id_department= '$_GET[idParaEditarx]'");
    
    $municipality = array();
    $municipality2 = array();
    while ($r = $query->fetch_object()) {
        $municipality[] = $r;
    }
    while ($r = $query2->fetch_object()) {
        $municipality2[] = $r;
    }


    if (count($municipality) > 0) {
        print "<option value='' selected disabled hidden>Seleccione una opción '$_GET[departamentoaddx]' </option>    ";
        foreach ($municipality as $municipality) {
            print "<option value='$municipality->id_municipality'>$municipality->name_municipality</option>";
        }
    } else {
        print "<option value=''>-- NO HAY DATOS --</option>";
    }





?>
