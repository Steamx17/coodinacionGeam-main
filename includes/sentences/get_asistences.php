<?php 
require_once('../load.php');
//$pdo = new PDO("mysql:dbname=coordinacion;host localhost","root","");
global $pdo;
$sql =  $pdo->prepare(" SELECT a.id_assistance, 
a.date_assistance, 
a.start_time_assistance,
a.end_time_assistance,
a.time_elapsed_assistance,
t.fullname_teacher,
s.name_subject, 
a.socialized_material_assistance, 
a.main_theme_assistance, 
a.institution_assistance, 
g.name_group, 
a.evidence_assistance
FROM assistance a INNER JOIN teacher t ON 
a.teacher_assistance= t.id_teacher INNER JOIN subject s ON 
t.subject_teacher = s.id_subject INNER JOIN troop g ON 
a.group_assistance = g.id_group  ORDER BY  id_assistance DESC");
$sql->execute();
$result =$sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
