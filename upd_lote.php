<?
include ("conec.php");

$SQL = mysql_query("SELECT Lote_nro, Familia_nro FROM `dbo_lote` WHERE Familia_nro IS NOT NULL", $link);



while ($lote = mysql_fetch_array($SQL)) {


$Lote_nro = $lote["Lote_nro"];

$Familia_nro = $lote["Familia_nro"];


$upd = "UPDATE dbo_familia SET Lote_nro = $Lote_nro WHERE Familia_nro = $Familia_nro";

if (mysql_query ($upd,$link)) {echo $num." - Actualizado<br>"; }else{echo "Error<br>";}

}

?>