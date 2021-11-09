<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_lote WHERE blnConv2 = '0' ORDER BY Lote_nro ASC LIMIT 500");

$cant = mysql_num_rows($res);



echo "Actualizando registros: ";



while ($lote = mysql_fetch_array($res)) {

$loteNum = $lote["Lote_nro"];

$Lote_circ = $lote["Lote_circunscripcion"];

$Lote_secc = $lote["Lote_seccion"];

$Lote_manzana = $lote["Lote_manzana"];
$Lote_mz_limp = ereg_replace("[^A-Za-z0-9]", "", $Lote_manzana);

$Lote_parcela = $lote["Lote_parcela"];
$Lote_pc_limp = ereg_replace("[^A-Za-z0-9]", "", $Lote_parcela);



$sql8 = "SELECT Familia_nro FROM dbo_familia where Lote_nro = $loteNum";
$res8 = mysql_query($sql8);
$familia = mysql_fetch_array ($res8);

$idFamilia = $familia["Familia_nro"];


$upd = "UPDATE dbo_familia SET 
Lote_circunscripcion = '$Lote_circ',
Lote_seccion = '$Lote_secc',
Lote_manzana = '$Lote_mz_limp',
Lote_parcela = '$Lote_pc_limp'
where Familia_nro = '$idFamilia'";

if (mysql_query($upd,$link))  { 

$upd2 = "UPDATE dbo_lote SET
blnConv2 = '1' WHERE Lote_nro = '$loteNum'";

if (mysql_query($upd2,$link)) {


echo $loteNum." - ";


 }else{ echo "error"; }}


}

echo "</br></br>Registros actualizados correctamente.<br>";

?>