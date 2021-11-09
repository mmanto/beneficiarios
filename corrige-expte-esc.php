<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_familia WHERE Expte_esc_nro != '0'",$link);

while ($familia = mysql_fetch_array($res)) {
echo $familia["Familia_nro"]." - ".$familia["Expte_esc_nro"]." - ".$familia["Expte_escrit_nro"] ."<br>";

//$numExpte = $familia["Expte_esc_nro"];

//$numFlia = $familia["Familia_nro"];

$sql = mysql_query("UPDATE dbo_familia SET Expte_escrit_nro = '$numExpte' WHERE Familia_nro = $numFlia");


}
