<?php

//consulta SQL
$sql="select * from 	lessons "; 
$dato=$db->query($sql); 

//cuando tengas tus valores calculados de todo simplemente hacer un echo
echo $dato;

?>