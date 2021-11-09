<?
include("cabecera.php");
include ("conec.php");

$valor = $_POST["sysactivo"];

if($valor == '1') {$estado = "activado"; }else{$estado = "desactivado";}

$sql = "UPDATE dbo_settings SET Valor = $valor WHERE idSetting = 4";

if(mysql_query($sql)) { echo "<h2>El sitio ha sido ".$estado."</h2>"; }else{ echo "<h2>No se pudo modificar el estado</h2>"; }

echo "<p><a href='sbt-menu.php'>Volver al menu principal</a></p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";

include ("pie.php");

?>