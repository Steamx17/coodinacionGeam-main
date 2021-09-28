<?php
require_once(LIB_PATH_INC . DS . "config.php");

class MySqli_DB
{

  private $con;
  public $query_id;

  function __construct()
  {
    $this->db_connect();
  }

  /*--------------------------------------------------------------*/
  /* Función para conexión de base de datos abierta
/*--------------------------------------------------------------*/
  public function db_connect()
  {
    $this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    //$this->con->set_charset("utf8");
    if (!$this->con) {
      echo "
      <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap' );
      
      @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700');
      
      *{
        margin:0;
        padding:0;
        box-sizing:border-box;
      }
      
      body{
        overflow:hidden;
        background-color: #f4f6ff;
      }
      
      .container{
        width:100vw;
        height:100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        position: relative;
        left:6vmin;
        text-align: center;
      }
      
      .cog-wheel1, .cog-wheel2{
        transform:scale(0.7);
      }
      
      .cog1, .cog2{
        width:40vmin;
        height:40vmin;
        border-radius:50%;
        border:6vmin solid #f3c623;
        position: relative;
      }
      
      
      .cog2{
        border:6vmin solid #4f8a8b;
      }
      
      .top, .down, .left, .right, .left-top, .left-down, .right-top, .right-down{
        width:10vmin;
        height:10vmin;
        background-color: #f3c623;
        position: absolute;
      }
      
      .cog2 .top,.cog2  .down,.cog2  .left,.cog2  .right,.cog2  .left-top,.cog2  .left-down,.cog2  .right-top,.cog2  .right-down{
        background-color: #4f8a8b;
      }
      
      .top{
        top:-14vmin;
        left:9vmin;
      }
      
      .down{
        bottom:-14vmin;
        left:9vmin;
      }
      
      .left{
        left:-14vmin;
        top:9vmin;
      }
      
      .right{
        right:-14vmin;
        top:9vmin;
      }
      
      .left-top{
        transform:rotateZ(-45deg);
        left:-8vmin;
        top:-8vmin;
      }
      
      .left-down{
        transform:rotateZ(45deg);
        left:-8vmin;
        top:25vmin;
      }
      
      .right-top{
        transform:rotateZ(45deg);
        right:-8vmin;
        top:-8vmin;
      }
      
      .right-down{
        transform:rotateZ(-45deg);
        right:-8vmin;
        top:25vmin;
      }
      
      .cog2{
        position: relative;
        left:-10.2vmin;
        bottom:10vmin;
      }
      
      h1{
        color:#142833;
      }
      
      .first-four{
        position: relative;
        left:6vmin;
        font-size:40vmin;
      }
      
      .second-four{
        position: relative;
        right:18vmin;
        z-index: -1;
        font-size:40vmin;
      }
      
      .wrong-para{
        font-family: 'Montserrat', sans-serif;
        position: absolute;
        bottom:15vmin;
        padding:3vmin 12vmin 3vmin 3vmin;
        font-weight:600;
        color:#092532;
      }
      </style>
      
      <!DOCTYPE html>
      <html lang='en'>
      
      <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>ERROR  | GEAM</title>
        <link rel='icon' href='../assets/dist/img/favicon.ico'>
      
      
      <body >
      <div class='container'>
        <h1 class='first-four'></h1>
        <div class='cog-wheel1'>
            <div class='cog1'>
              <div class='top'></div>
              <div class='down'></div>
              <div class='left-top'></div>
              <div class='left-down'></div>
              <div class='right-top'></div>
              <div class='right-down'></div>
              <div class='left'></div>
              <div class='right'></div>
          </div>
        </div>
        
        <div class='cog-wheel2'> 
          <div class='cog2'>
              <div class='top'></div>
              <div class='down'></div>
              <div class='left-top'></div>
              <div class='left-down'></div>
              <div class='right-top'></div>
              <div class='right-down'></div>
              <div class='left'></div>
              <div class='right'></div>
          </div>
        </div>
       <h1 class='second-four'></h1>
        <p class='wrong-para'>Uh Oh! No se pudo establecer conexión con la base de datos.  <a  href='javascript:location.reload()'> Volver  a cagar la página. </a></p>
       
      </div>
      
      ";
      die(" Database connection failed:" . mysqli_connect_error());
    } else {
      $select_db = $this->con->select_db(DB_NAME);
      if (!$select_db) {
        die("Failed to Select Database" . mysqli_connect_error());
  
      }
    }
  }
  /*--------------------------------------------------------------*/
  /* Función para cerrar la conexión de la base de datos
/*--------------------------------------------------------------*/

  public function db_disconnect()
  {
    if (isset($this->con)) {
      mysqli_close($this->con);
      unset($this->con);
    }
  }
  /*--------------------------------------------------------------*/
  /* Función para consulta mysqli
/*--------------------------------------------------------------*/
  public function query($sql)
  {

    if (trim($sql != "")) {
      $this->query_id = $this->con->query($sql);
    }
    if (!$this->query_id)
      // only for Develope mode
      die("Error en esta consulta :<pre> " . $sql . "</pre>");
    // For production mode
    //  die("Error on Query");

    return $this->query_id;
  }

  /*--------------------------------------------------------------*/
  /* Función para el asistente de consultas
/*--------------------------------------------------------------*/
  public function fetch_array($statement)
  {
    return mysqli_fetch_array($statement);
  }
  public function fetch_object($statement)
  {
    return mysqli_fetch_object($statement);
  }
  public function fetch_assoc($statement)
  {
    return mysqli_fetch_assoc($statement);
  }
  public function num_rows($statement)
  {
    return mysqli_num_rows($statement);
  }
  public function insert_id()
  {
    return mysqli_insert_id($this->con);
  }
  public function affected_rows()
  {
    return mysqli_affected_rows($this->con);
  }
  /*--------------------------------------------------------------*/
  /* Función para Eliminar escapes especiales
  /*   caracteres en una cadena para usar en una instrucción SQL
 /*--------------------------------------------------------------*/
  public function escape($str)
  {
    return $this->con->real_escape_string($str);
  }
  /*--------------------------------------------------------------*/
  /* Función para bucle while
/*--------------------------------------------------------------*/
  public function while_loop($loop)
  {
    global $db;
    $results = array();
    while ($result = $this->fetch_array($loop)) {
      $results[] = $result;
    }
    return $results;
  }
}

$db = new MySqli_DB();
