<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


$sql3 = mysql_query("SELECT * FROM
dbo_expte_esc where Expte_caract like '2423' AND 
Expte_num like '350'
",$link);
?>
<form action="expte-test-process" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<? 
while ($expte = mysql_fetch_array($sql3)) {

$exptenum = $expte["Expte_num"];
$expte_caract = $expte["Expte_caract"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

echo $expte_caract."-".$exptenum."/".$expte_anio."<br>";

?>
<tr>
<td width="3%"><input name="expte_esc" type="radio" value="<?=$expte["Expte_nro"]; ?>"></td><td width="97%"><? echo $expte_caract."-".$exptenum."/".$expte_anio; ?></td>
</tr>
<? } ?>
</table>
<input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar"  />
</form>