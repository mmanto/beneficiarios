<?


include ("conec.php");


echo "A";

$res = mysql_query("SELECT * FROM dbo_familia ORDER BY Familia_nro ASC LIMIT 50000");


while ($familia = mysql_fetch_array($res)) {

//$idFamilia = $familia["Familia_nro"];

echo $familia["Lote_manzana"]." - ".$familia["Lote_parcela"]." | ".$familia["Lote_manzana_limp"]." - ".$familia["Lote_parcela_limp"]."</br>";

}

?>