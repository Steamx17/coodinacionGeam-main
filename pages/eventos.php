<?php
header('Content-Type: application/json');
$pdo = new PDO("mysql:dbname=coordinacion;host=localhost", "root", "");
//W$pdo = new PDO("mysql:dbname=grupogea_+coordinacion;host=localhost", "grupogea_coordinacion", "coordinacion");
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    case 'agregar':
        //echo "Intruccion agregar";
        $sentenciaSQL = $pdo->prepare("INSERT INTO eventos values(:title_lessons,:date_start,:date_end,:description,:colour_lessons,:textcolour_lessons,:teacher_lessons,:namegroup_lessons)");
        $respuesta = $sentenciaSQL->execute(array(
            "title_lessons" => $_POST['title'],
            "date_start" => $_POST['date_start'],
            "date_end" => $_POST['date_end'],
            "description" => $_POST['description'],
            "colour_lessons" => $_POST['colour_lessons'],
            "textcolour_lessons" => $_POST['textcolour_lessons'],
            "teacher_lessons" => $_POST['teacher_lessons'],
            "namegroup_lessons" => $_POST['namegroup_lessons']
        ));
        echo json_encode($respuesta);
        break;
    case 'eliminar':
        //    echo "Intruccion eliminar";
        $respuesta = false;
        if (isset($_POST['id'])) {
            $sentenciaSQL = $pdo->prepare("DELETE FROM eventos WHERE id= :id");
            $respuesta = $sentenciaSQL->execute(array("id" => $_POST['id']));
        }
        echo json_encode($respuesta);
        break;

    case 'modificar':
        //echo "Intruccion modificar";
        $sentenciaSQL = $pdo->prepare("UPDATE eventos SET
        title = :title,
        descripcion = :descripcion,
        color= :color,
        textColor= :textColor,
        start= :start,
        end = :end
        WHERE id= :id");
        $respuesta = $sentenciaSQL->execute(array(
            "id" => $_POST['id'],
            "title" => $_POST['title'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "start" => $_POST['start'],
            "end" => $_POST['end']
        ));
        echo json_encode($respuesta);
        break;
    default:
        //SELECCIONAR LOS EVENTOS DEL CALENDARIO
        $sentenciaSQL = $pdo->prepare("SELECT * FROM lessons");
        $sentenciaSQL->execute();

        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
}
