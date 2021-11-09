<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_lote WHERE blnConv3 = '0' ORDER BY Lote_nro ASC LIMIT 0,200");

while ($lote = mysql_fetch_array($res)) {

//$familiaNum = $familia["Familia_nro"];


$loteNum = $lote["Lote_nro"];

$loteCirc = $lote["Lote_circunscripcion"];
$loteSecc = $lote["Lote_seccion"];
$loteCh = $lote["Lote_chacra"];
$loteQta = $lote["Lote_quinta"];
$loteFracc = $lote["Lote_fraccion"];
$loteMz = $lote["Lote_manzana"];
$lotePc = $lote["Lote_parcela"];
$loteSubpc = $lote["Lote_subparcela"];


//Describir variables de nomenclatura!

$upd = "UPDATE dbo_familia SET 
Lote_circunscripcion = '$loteCirc',
Lote_seccion = '$loteSecc',
Lote_chacra = '$loteCh',
Lote_quinta = '$loteQta',
Lote_fraccion = '$loteFracc',
Lote_manzana = '$loteMz',
Lote_parcela = '$lotePc',
Lote_subparcela = '$loteSubpc'
WHERE Lote_nro = '$loteNum'";

if(mysql_query($upd)) {


$upd2 = "UPDATE dbo_lote SET blnConv3 = '1' WHERE Lote_nro = $loteNum";

if(mysql_query ($upd2)) {

echo "Ok - ".$loteNum."</br>";

}else{ echo "error</br>";

} }

}

?>
