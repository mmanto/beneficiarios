<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_familia WHERE Lote_manzana = '0' AND Lote_parcela = '0' AND Lote_nro != '0' ORDER BY Familia_nro ASC LIMIT 0,15000");

while ($familia = mysql_fetch_array($res)) {

//$familiaNum = $familia["Familia_nro"];


$loteNum = $familia["Lote_nro"];

$upd = "UPDATE dbo_lote SET blnConv3 = '0' WHERE Lote_nro = '$loteNum'";

if(mysql_query($upd)) {

echo "Ok - ".$loteNum."</br>";
}else{ echo "error</br>";

}

}

?>