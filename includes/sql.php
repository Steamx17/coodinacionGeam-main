<?php
require_once('load.php');

//FUNCION PARA VERIFICAR CONEXION

function verificarConexionBD()
{
  global $db;
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  /* comprobar si el servidor sigue vivo */
  if ($mysqli->ping()) {
    printf("¡La conexión está con la BD bien!\n");
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
  if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
  }
}

function find_all($table)
{
  global $db;
  if (tableExists($table)) {
    return find_by_sql("SELECT * FROM " . $db->escape($table));
  }
}

function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return $result_set;
}

function find_by_id($table, $id)
{
  global $db;
  $id = (int) $id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}'");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function find_by_id_user($table, $id)
{
  global $db;
  $id = (int) $id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}'");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function delete_by_id($table, $id)
{
  global $db;
  if (tableExists($table)) {
    $sql = "DELETE FROM " . $db->escape($table);
    $sql .= " WHERE idbox=" . $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}

function tableExists($table)
{
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
  if ($table_exit) {
    if ($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
}

function authenticate($username = '', $password = '')
{
  global $db;
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql  = sprintf("SELECT id,iduser,password FROM users WHERE iduser ='%s' LIMIT 1", $username);
  $result = $db->query($sql);
  if ($db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $password_request = sha1($password);
    if ($password_request === $user['password']) {
      return $user['id'];
    }
  }
  return false;
}

function page_require_tipo($require_level)
{
  global $session;
  global $db;
  $sql = "SELECT tipo FROM users WHERE   tipo = '$require_level'";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

function current_user()
{
  static $current_user;
  global $db;
  if (!$current_user) {
    if (isset($_SESSION['user_idgeam'])) :
      $user_id = intval($_SESSION['user_idgeam']);
      $current_user = find_by_id('users', $user_id);
    endif;
  }
  return $current_user;
}

function updateLastLogIn($user_id)
{
  global $db;
  $date = make_date();
  $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
  $result = $db->query($sql);
  return ($result && $db->affected_rows() === 1 ? true : false);
}



function findAllTeachers()
{
  global $db;
  $sql  = "SELECT t.id_teacher,
   t.names_teacher,
    t.surnames_teacher , 
    t.fullname_teacher ,
     t.observations_teacher ,
     t.status, 
     s.name_subject FROM teacher  t INNER JOIN subject s  ON s.id_subject = t.subject_teacher  ORDER BY  id_teacher DESC";
  return find_by_sql($sql);
}

function findAllsubject()
{
  global $db;
  $sql  = "SELECT * FROM subject ORDER BY  id_subject DESC";
  return find_by_sql($sql);
}
function findAllgroup()
{
  global $db;
  //$sql  = "SELECT * FROM troop ORDER BY  id_group DESC";
  $sql  = "SELECT m.id_municipality, m.name_municipality,t.id_group,t.cod_group,t.name_group,t.grade_group,t.observation_group, d.name_department FROM municipality AS m INNER JOIN troop AS t ON t.id_municipality = m.id_municipality  INNER JOIN department  AS  d ON m.id_department = d.id_department ORDER BY id_group DESC";

  return find_by_sql($sql);
}
function findAllasistance()
{
  global $db;
  $sql  = "SELECT a.id_assistance, 
  a.date_assistance, 
  s.name_subject,
  a.start_time_assistance,
  a.end_time_assistance,
  a.time_elapsed_assistance,
  c.name_colleges,
  a.socialized_material_assistance, 
  a.number_assistants,
  a.main_theme_assistance, 
  a.evidence_assistance,
	l.title,
  l.start,
  l.teacher_lessons,
  l.namegroup_lessons,
  a.observations_assistance
  FROM assistance a INNER JOIN colleges c ON  c.id_colleges = a.id_colleges 
  INNER JOIN subject s ON  s.id_subject = a.id_subject 
  INNER JOIN lessons l ON  l.id_lessons = a.id_class
  ORDER BY  id_assistance DESC";
  return find_by_sql($sql);
}
function findAllasistanceLimit1000()
{
  global $db;
  $sql  = "SELECT a.id_assistance, 
  s.name_subject,
    a.date_assistance, 
    a.start_time_assistance,
    a.end_time_assistance,
    a.time_elapsed_assistance,
    c.name_colleges,
    a.socialized_material_assistance, 
    a.number_assistants,
    a.main_theme_assistance, 
    a.evidence_assistance,
    l.title,
    l.start,
    l.teacher_lessons,
    l.namegroup_lessons,
    a.observations_assistance
  
    FROM assistance a INNER JOIN colleges c ON  c.id_colleges = a.id_colleges 
    INNER JOIN subject s ON  s.id_subject = a.id_subject 
    INNER JOIN lessons l ON  l.id_lessons = a.id_class
    ORDER BY  id_assistance DESC LIMIT 1000";
  return find_by_sql($sql);
}

function findAllasistanceLimit()
{
  global $db;
  $sql  = "SELECT a.id_assistance, 
  a.date_assistance, 
  a.start_time_assistance,
  s.name_subject,
  a.end_time_assistance,
  a.time_elapsed_assistance,
  c.name_colleges,
  a.socialized_material_assistance, 
  a.number_assistants,
  a.main_theme_assistance, 
  a.evidence_assistance,
	l.title,
l.teacher_lessons,
l.namegroup_lessons,
  a.observations_assistance
  FROM assistance a INNER JOIN colleges c ON  c.id_colleges = a.id_colleges 
INNER JOIN subject s ON  s.id_subject = a.id_subject 
 INNER JOIN lessons l ON  l.id_lessons = a.id_class
ORDER BY  id_assistance DESC LIMIT 100";
  return find_by_sql($sql);
}

function findAllstudents()
{
  global $db;
  $sql  = " SELECT s.id_students,
  s.identification_students,
  s.names_students,
  g.name_group
   FROM students  s INNER JOIN  troop g ON g.id_group = s.group_students ORDER BY  id_students DESC";
  return find_by_sql($sql);
}


function findGroup($id)
{
  global $db;
  $sql = " SELECT * FROM troop  WHERE  id_group = '$id' limit 1";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

function countGroup()
{
  global $db;
  $sql  = "SELECT COUNT(*) as total FROM troop";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}
function countAsistence()
{
  global $db;
  $sql  = "SELECT COUNT(*) as total FROM assistance";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}
function countTeacher()
{
  global $db;
  $sql  = "SELECT COUNT(*) as total FROM teacher";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

function countStudentsGroup($id_group)
{
  global $db;
  $sql  = "select COUNT(*) as total  from students WHERE group_students = '.$id_group.'";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}





function groupById($id_group)
{
  global $db;
  $sql  = "select *  from troop WHERE id_group = '.$id_group.'";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}
function findAllstudentsById($id_group)
{
  global $db;
  $sql  = "SELECT s.id_students,
  s.identification_students,
  s.names_students,
  g.name_group,
  g.cod_group
   FROM students  s INNER JOIN  troop g ON g.id_group = s.group_students WHERE g.id_group=" . $id_group . "";
  return find_by_sql($sql);
}

function findSubjectById($nameSubeject)
{

  global $db;
  $sql  = "SELECT id_subject from subject 
  WHERE name_subject = '" . $nameSubeject . "' LIMIT 1";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

function findAllDepartaments()
{
  global $db;
  $sql  = "SELECT * FROM department ";
  return find_by_sql($sql);
}

function findAllIN()
{
  global $db;
  $sql  = "SELECT * FROM department ";
  return find_by_sql($sql);
}




function findAllInstitutions()
{
  global $db;
  $sql  = "SELECT c.name_colleges,d.name_department,m.name_municipality  FROM colleges c 
  INNER JOIN municipality m ON m.id_municipality = c.id_municipality INNER JOIN 
  department d ON d.id_department= m.id_municipality ORDER BY id_colleges DESC";
  return find_by_sql($sql);
}

function countInstitutions()
{
  global $db;
  $sql  = "SELECT COUNT(*) as total from colleges limit 1";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}
function findAllClass()
{
  global $pdo;
  $sql  = "SELECT id_lessons,title,start,end,description,teacher_lessons,namegroup_lessons FROM lessons ORDER BY id_lessons desc";
  return find_by_sql($sql);
}
function countClass()
{
  global $db;
  $sql  = "SELECT COUNT(*) as total from lessons limit 1";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

function findLessonsId($id_lessons)
{

  global $db;
  $sql  = "SELECT * FROM lessons WHERE id_lessons =  '" . $id_lessons . "' LIMIT 1";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

function findIdTeacher($name)
{
  global $db;
  $sql  = "SELECT id_teacher FROM teacher WHERE fullname_teacher ='" . $name . "' limit 1";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

function findUserId($iduser)
{
  global $db;
  $sql  = "SELECT COUNT(iduser) as total FROM users WHERE iduser ='" . $iduser . "' limit 1";

  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}
