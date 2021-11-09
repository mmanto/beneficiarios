<?php

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_familia WHERE Expte_esc_nro != '0'");
$num_fila = '1';
?>
<table width="760" border="0" cellspacing="5" cellpadding="3">
  <tr>
    <td width="136" height="36" align="center" bgcolor="#D8E1E9">Familia n&uacute;mero </td>
    <td width="274" align="center" bgcolor="#D8E1E9">Expte seg&uacute;n origen </td>
    <td width="255" align="center" bgcolor="#D8E1E9">Expte seg&uacute;n migraci&oacute;n </td>
    <td width="46" align="center" bgcolor="#D8E1E9">&nbsp;</td>
  </tr>
<? while($familia = mysql_fetch_array($res)) { 

$familia_nro = $familia["Familia_nro"];
$expte_orig = $familia["Expte_esc_nro_BK2"];
$expte_nw = $familia["Expte_esc_nro"];



$res2 = mysql_query("SELECT * FROM dbo_expte_esc_ORIG WHERE Expte_nro = $expte_orig");
$expte_origen = mysql_fetch_array($res2);


$res3 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_nro = $expte_nw");
$expte_nw = mysql_fetch_array($res3);




$cadena1 = $expte_origen["Expte_caract"]."-".$expte_origen["Expte_num"]."/".$expte_origen["Expte_anio"]." Alc.".$expte_origen["Expte_alcance"];

$cadena2 = $expte_nw["Expte_caract"]."-".$expte_nw["Expte_num"]."/".$expte_nw["Expte_anio"]." Alc.".$expte_nw["Expte_alcance"];

?>
 <tr <? if ($num_fila%2==0) { ?>bgcolor="#E4E4E4"<? } ?>>
    <td align="center"><? echo $familia["Familia_nro"]; ?>&nbsp;</td>
    <td align="center"><strong><? echo $expte_origen["Expte_nro"]; ?></strong> | <? echo $cadena1; ?>&nbsp;</td>
    <td align="center"><strong><? echo $expte_nw["Expte_nro"]; ?></strong>| <? echo $cadena2; ?>&nbsp;</td>
    <td align="center"><? if ($cadena1 == $cadena2) { echo "<img src='imagen/check.png' width='20' height='20' border='0' />";} else{ echo "<img src='imagen/drop.png' width='16' height='16' border='0' />"; } ?>
      </td>
    <? 
$num_fila++;
} ?>	
  </tr>
</table>
<? include("pie.php"); ?>