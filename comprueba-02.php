<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_familia WHERE Lote_circunscripcion = '0' AND Lote_seccion = '0' ORDER  BY Lote_nro ASC LIMIT 50000");

$cant = mysql_num_rows($res);

echo $cant."</br></br>";

while ($familia = mysql_fetch_array($res)) {

$loteNum = $familia["Lote_nro"];

$Familia_manzana = $familia["Lote_manzana"];
$Familia_circunscripcion = $familia["Lote_circunscripcion"];
$Familia_seccion = $familia["Lote_seccion"];
$lotefamnro = $familia["Familia_nro"];

$res2 = mysql_query("SELECT * FROM dbo_lote WHERE Lote_nro = $loteNum");

while ($lote = mysql_fetch_array($res2)) {

$Lote_manzana = $lote["Lote_manzana"];
$Lote_circunscripcion = $lote["Lote_circunscripcion"];
$Lote_seccion = $lote["Lote_seccion"];
$Lote_parcela = $lote["Lote_parcela"];

echo "(".$lotefamnro.") ".$Familia_circunscripcion. " - ".$Familia_seccion." - ".$Familia_manzana." *** ".$Lote_circunscripcion." - ".$Lote_seccion." - ".$Lote_manzana." - ".$Lote_parcela."</br>";

}}