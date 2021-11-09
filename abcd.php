<?
include ("conec.php");

$sqlNota = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = 1",$link);

$nota = mysql_fetch_array($sqlNota);

$nota_num = $nota["Valor"];

$nueva_nota = $nota_num+1;

$suma = mysql_query("UPDATE dbo_settings SET valor = '$nueva_nota' WHERE idSetting = 1"); 

echo "nota: ".$nota_num;

?>