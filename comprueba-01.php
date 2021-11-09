<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_lote WHERE Lote_circunscripcion = '7' ORDER  BY Lote_nro ASC LIMIT 200");

$cant = mysql_num_rows($res);

while ($lote = mysql_fetch_array($res)) {

$loteNum = $lote["Lote_nro"];

$Lote_manzana = $lote["Lote_manzana"];
$Lote_circunscripcion = $lote["Lote_circunscripcion"];
$Lote_seccion = $lote["Lote_seccion"];

$res2 = mysql_query("SELECT * FROM dbo_familia WHERE Lote_nro = $loteNum");

while ($lotefam = mysql_fetch_array($res2)) {

$Familia_manzana = $lotefam["Lote_manzana"];
$Familia_circunscripcion = $lotefam["Lote_circunscripcion"];
$Familia_seccion = $lotefam["Lote_seccion"];
$lotefamnro = $lotefam["Familia_nro"];

echo $Lote_circunscripcion." - ".$Lote_seccion." *** ".$Familia_circunscripcion. " - ".$Familia_seccion." (".$lotefamnro.")</br>";

}}