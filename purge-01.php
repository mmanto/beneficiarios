<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT Lote_nro, Lote_matricula FROM dbo_lote WHERE Lote_matricula != '0' LIMIT 0,5000");

$cant = mysql_num_rows($res);

echo $cant."<br><br>";

$ord = '1';

while ($lote = mysql_fetch_array($res)) {

$loteNum = $lote["Lote_nro"];
$lote_mat = $lote["Lote_matricula"];


$sql8 = "SELECT Familia_nro, Familia_matricula FROM dbo_familia where Lote_nro = $loteNum";
$res8 = mysql_query($sql8);
$familia = mysql_fetch_array ($res8);

$idFamilia = $familia["Familia_nro"];


/* $upd = "UPDATE dbo_familia SET Familia_matricula = '$lote_mat' where Familia_nro = '$idFamilia'";

if (mysql_query($upd,$link))  { */

echo $lote["Lote_matricula"]." - ".$familia["Familia_matricula"]."<br>";

// }else{ echo "error"; }

//$ord++;


}

?>