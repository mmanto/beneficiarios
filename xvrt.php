<?

include ("conec.php");

$SQL = mysql_query("SELECT Lote_nro, Familia_nro FROM dbo_lote WHERE Familia_nro IS NOT NULL",$link);

while ($lote = mysql_fetch_array($SQL)) {

echo "Lote: ".$lote["Lote_nro"]." - Familia: ".$lote["Familia_nro"]."<br>";

}