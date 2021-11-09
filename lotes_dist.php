<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT DISTINCT Lote_manzana FROM dbo_familia",$link);

while ($familia = mysql_fetch_array($res)) {

echo $familia["Lote_manzana"]." | ";

}

?>