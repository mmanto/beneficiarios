<?
include ("cabecera.php");
include ("conec.php");
//require ("funciones.php");

$exptecaract = $_POST["expte-caract"];

$exptenum = $_POST["expte-num"];

$origen = $_POST["origen"];

$familia = $_POST["idFamilia"];


if (!$_POST["expte-num"]) {

$sql = mysql_query("SELECT * FROM dbo_expte_esc WHERE Expte_caract like $exptecaract",$link);

}else{


if (!$_POST["expte-caract"]) {


$sql = mysql_query("SELECT * FROM dbo_expte_esc WHERE Expte_num like $exptenum",$link);

}else{


$sql = mysql_query("SELECT * FROM dbo_expte_esc WHERE Expte_caract like $exptecaract AND Expte_num like $exptenum",$link);
}}
?>
<form action="actualiza_expte.php" method="post">
<h1>Seleccione el expediente que corresponda</h1>
<p><a href="javascript:history.back()">Volver</a></p>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<? 
while ($expte = mysql_fetch_array($sql)) {

$expte_num = $expte["Expte_num"];
$expte_caract = $expte["Expte_caract"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];
?>
<tr>
<td width="3%"><input name="expte_esc" type="radio" value="<?=$expte["Expte_nro"]; ?>"></td><td width="97%" style="font-size:18px"><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alcance ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cuerpo ".$expte_cuerpo; }else{ echo " "; } ?></td>
</tr>
<? } ?>
<tr>
  <td width="3%"><input name="expte_esc" type="radio" value="0" /></td>
  <td width="97%" style="font-size:18px">Eliminar el expediente actualmente relacionado</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td style="font-size:18px">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td style="font-size:18px">
  <input type="hidden" name="origen" value="<?=$origen; ?>" />
  <input type="hidden" name="idFamilia" value="<?=$familia; ?>" />
  <input name="cmdAccion" type="submit" id="cmdAccion" value="Seleccionar"  /></td>
</tr>
</table>
</form>