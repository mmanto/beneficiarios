<?php
session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
}

$tabla_Famila = " dbo_familia ";

mysql_select_db("MyTierras",$link);

$nros_familia = $_POST['seleccion'];
$primer_familia = $nros_familia[0];

$qry = "UPDATE $tabla_Famila SET Familia_req_estado = 1 WHERE ";
foreach ($nros_familia as $id){ 
   if ($id == $primer_familia){
   	$qry .= " Familia_nro = $id "; 
   } else {
   	$qry .= " OR Familia_nro = $id ";
   }
} 

$resultado = mysql_query($qry);
if ($resultado != 0){
	echo "Operación exitosa.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
} else {
	echo "No se puedieron realizar los cambios. Vuelva a intentarlo.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
}



?>