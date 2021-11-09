<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$sql = "SELECT * FROM dbo_partido WHERE Partido_conurbano = '1'";
$res = mysql_query($sql);

while($partido = mysql_fetch_array($res)) {

$partido_nro = $partido["Partido_nro"];

$partido_nombre = $partido["Partido_nombre"];

$upd = "UPDATE dbo_barrio SET Barrio_conurbano = '1' WHERE Partido_nro = $partido_nro";

if(mysql_query($upd)) { echo $partido_nombre." - OK</br>"; }

}

?>