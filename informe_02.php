<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);

$sql = "SELECT COUNT(Expte_nro) FROM dbo_expte_esc WHERE Expte_salida_destino = 1";
$res1 = mysql_query($sql);
$count1 = mysql_fetch_array($res1);

$sql2 = "SELECT COUNT(Expte_nro) FROM dbo_expte_esc WHERE Expte_salida_destino = 2";
$res2 = mysql_query($sql2);
$count2 = mysql_fetch_array($res2);

$sql3 = "SELECT COUNT(Expte_nro) FROM dbo_expte_esc WHERE Expte_salida_destino = 3";
$res3 = mysql_query($sq3);
$count3 = mysql_fetch_array($res3);

$sql4 = "SELECT COUNT(Expte_nro) FROM dbo_expte_esc WHERE Expte_salida_destino = 4";
$res4 = mysql_query($sql4);
$count4 = mysql_fetch_array($res4);

?>

<p>Expedientes enviados a EGG:  <? echo $count1[0]; ?></p>
<p>Expedientes en Municipio: <? echo $count2[0]; ?></p>
<p>Exptes en Ministerio de Infraestructura: <? echo $count3[0]; ?></p>
<p>Exptes en Instituto de la Vivienda:  <? echo $count4[0]; ?></p>