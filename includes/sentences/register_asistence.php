<?php
include "../load.php";


/*echo  "fecha ".$_POST['fechaadd']."<br>"; 
echo"profesor ". $_POST['profesoradd']."<br>"; 
echo "asignatura ".$_POST['asignaturaadd']."<br>"; 
 
echo "meterial ".$_POST['materialsocializadoadd']."<br>"; 

echo "eje ".$_POST['ejetematicoadd']."<br>"; 
echo "institucion  ".$_POST['institucionadd']."<br>"; 
echo "grupo ".$_POST['grupoadd']."<br>"; 
echo "observaciones ".$_POST['observacionesadd']."<br>"; 
echo "evidencia ". $_FILES['evidenceadd']['name']."<br>"; 

echo "hora de  inicio ".$_POST['horainicioadd']."<br>"; 
echo "hora final ".$_POST['horafinaladd']."<br>"; 
echo "tiempo transcurrido ".$_POST['horas_justificacion_real']."<br>"; */
if (isset($_POST['numberassistants']) && isset($_POST['fechaadd']) && isset($_POST['horainicioadd']) && isset($_POST['horafinaladd']) && isset($_POST['horas_justificacion_real']) && isset($_POST['claseadd'])  && isset($_POST['materialsocializadoadd']) && isset($_POST['ejetematicoadd']) && isset($_POST['institucionadd'])) {
    $carpeta = "../../uploads/evidences/";
    $nombre = $_FILES['evidenceadd']['name'];

    $temp = explode('.', $nombre);
    $extension = end($temp);
    $i = 0;
    $nombreFinal = time()  . '.' . $extension;
    if ($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'pdf' || $extension == 'jpg') {
        if (move_uploaded_file($_FILES['evidenceadd']['tmp_name'], $carpeta . $nombreFinal)) {
            $user = current_user();
            $db->query("INSERT INTO assistance  VALUES(null,'" . $_POST['fechaadd'] . "',
            '" . $_POST['horainicioadd'] . "',
            '" . $_POST['horafinaladd'] . "',
            '" . $_POST['horas_justificacion_real'] . "',          
            '" . $_POST['institucionadd'] . "',
            '" . $_POST['claseadd'] . "',
            '" . $_POST['subjectadd'] . "',
            '" . $_POST['materialsocializadoadd'] . "',
            '" . $_POST['ejetematicoadd'] . "',             
            '" . $_POST['numberassistants'] . "',
            '" . $_POST['observacionesadd'] . "',
            '" . $nombreFinal . "',
            '" . make_date() . "',
            '" .  $user['name'] . "'
 )") or die($db->error);



            $session->msg('s', "Asistencia  agregada correctamente.");
            redirect('../../pages/add', false);
        } else {
            // header("Location: ../admin/productos.php?error=No se pudo subir la imagen");
            $session->msg('w', "No se pudo subir la imagen. ");
            redirect('../../pages/add', false);
        }
    } else {
        // header("Location: ../admin/productos.php?error=Favor de subir una imagen valida");
        $session->msg('w', "Favor de subir una imagen valida. (JPG,PNG,JPEG) ");
        redirect('../../pages/add', false);
    }
} else {
    $session->msg('d', "Favor de llenar todos los campos. ");
    redirect('../../pages/add', false);
}