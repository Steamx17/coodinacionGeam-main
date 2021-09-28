<?php
header('Content-Type: application/json');
//$pdo = new PDO("mysql:dbname=grupogea_coordinacion;host=localhost", "grupogea_coordinacion", "coordinacion");
$pdo = new PDO("mysql:dbname=coordinacion;host=localhost", "root", "");
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    case 'agregar':
        //echo "Intruccion agregar";
        $sentenciaSQL = $pdo->prepare("INSERT INTO lessons (title,start,end,description,color,textColor,teacher_lessons,namegroup_lessons) values(:title,:start,:end,:description,:color,:textColor,:teacher_lessons,:namegroup_lessons)");
        $respuesta = $sentenciaSQL->execute(array(
            "title" => $_POST['title'],
            "start" => $_POST['start'],
            "end" => $_POST['end'],
            "description" => $_POST['description'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "teacher_lessons" => $_POST['teacher_lessons'],
            "namegroup_lessons" => $_POST['namegroup_lessons']
        ));
        echo json_encode($respuesta);
        break;
    case 'eliminar':
        //    echo "Intruccion eliminar";
        $respuesta = false;
        if (isset($_POST['id_lessons'])) {
            $sentenciaSQL = $pdo->prepare("DELETE FROM lessons WHERE id_lessons= :id_lessons");
            $respuesta = $sentenciaSQL->execute(array("id_lessons" => $_POST['id_lessons']));
        }
        echo json_encode($respuesta);
        break;

    case 'modificar':
        //echo "Intruccion modificar";
        $sentenciaSQL = $pdo->prepare("UPDATE lessons SET
        title = :title,
        start = :start,
        end= :end,
        description= :description,
        color = :color,
        textColor = :textColor,
        teacher_lessons = :teacher_lessons,
        namegroup_lessons = :namegroup_lessons
        WHERE id_lessons= :id_lessons");
        $respuesta = $sentenciaSQL->execute(array(
            "id_lessons" => $_POST['id_lessons'],
            "title" => $_POST['title'],
            "start" => $_POST['start'],
            "end" => $_POST['end'],
            "description" => $_POST['description'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "teacher_lessons" => $_POST['teacher_lessons'],
            "namegroup_lessons" => $_POST['namegroup_lessons']
        ));
        echo json_encode($respuesta);
        break;
    default:
        //SELECCIONAR LOS EVENTOS DEL CALENDARIO
        $sentenciaSQL = $pdo->prepare("SELECT * FROM lessons where  teacher_lessons="."'".$_GET['profesor']."'");
        $sentenciaSQL->execute();

        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
}
