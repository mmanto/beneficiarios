<?

// Script para completar datos de nomenclatura faltante en la tabla dbo_familia (los toma de la table dbo_lote) 


include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_familia WHERE blnConv2 = '0' AND Lote_nro != '0' ORDER BY Familia_nro ASC LIMIT 500");

$cant = mysql_num_rows($res);

//echo "Actualizando registros: ";

while ($familia = mysql_fetch_array($res)) {

$familiaNum = $familia["Familia_nro"];
$loteNum = $familia["Lote_nro"];

$res2 = mysql_query("SELECT * FROM dbo_lote WHERE Lote_nro = $loteNum");

while ($lote = mysql_fetch_array($res2)) {

$Lote_circunscripcion = $lote["Lote_circunscripcion"];

$Lote_seccion = $lote["Lote_seccion"];

$Lote_manzana = $lote["Lote_manzana"];
$Lote_mz_limp = ereg_replace("[^A-Za-z0-9]", "", $Lote_manzana);

$Lote_parcela = $lote["Lote_parcela"];
$Lote_pc_limp = ereg_replace("[^A-Za-z0-9]", "", $Lote_parcela);

$upd = "UPDATE dbo_familia SET 
Lote_circunscripcion = '$Lote_circunscripcion',
Lote_seccion = '$Lote_seccion',
Lote_manzana = '$Lote_mz_limp',
Lote_parcela = '$Lote_pc_limp'
where Lote_nro = '$loteNum'";

if (mysql_query($upd,$link))  { 

$upd2 = "UPDATE dbo_famialia SET
blnConv2 = '1' WHERE Lote_nro = '$loteNum'";

echo $familiaNum."Ok<br>";

}

}} echo "Procesado";