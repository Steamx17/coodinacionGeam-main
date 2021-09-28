<?php
require_once('../includes/load.php');
if (!isset($_GET['evicencia']) ||  $_GET['evicencia']=="") {
    echo "ERROR,  HUBO UN ERROR AL LEER LA EVIDENVIA";
    echo "<br>";
    echo "<button onclick='window.close();'>Cerrar esta ventana </button>";
} else {

    if(verificarArchivo($_GET['evicencia'])){
?>
    <embed src="../uploads/evidences/<?php echo $_GET['evicencia']; ?>" type="application/pdf" id="visual" name="visual" width="100%" height="1000px" />
<?php }else{

echo "ERROR,  NO SE ENCONTRO EL ARCHIVO";
echo "<br>";
echo "<button onclick='window.close();'>Cerrar esta ventana </button>";
} }?>