<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

//echo $_POST["seleccion"];

$lista = implode(',',$_POST['seleccion']); 

//echo $lista;

$sql567 = mysql_query("SELECT * FROM dbo_expte_esc ORDER BY Expte_nro DESC",$link);

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) ORDER BY Partido_nombre ASC",$link);


?>
<table width="740" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td colspan="2" style="font-size:18px; font-weight:bold;">&iquest;Que acci&oacute;n desea realizar con los beneficios seleccionados?</td>
  </tr>
  <tr>
    <td colspan="2">ATENCI&Oacute;N: Recuerde que la acci&oacute;n que realice afectar&aacute; a todoslos beneficios que ha seleccionado en la pantalla anterior. </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="322"><table width="320" border="0" cellpadding="5" cellspacing="0" bgcolor="#dedede">
      <tr>
        <td height="36" ></td>
        <td height="36" colspan="3" valign="bottom" style="font-size:14px; font-weight:bold;">Asignar expediente de escrituraci&oacute;n </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Seleccione el expediente correspondiente del siguiente listado. Si desea quitar el expediente que tienen actualmente asignado, seleccione la opci&oacute;n &quot;quitar expediente asignado&quot;. </td>
        <td width="6%">&nbsp;</td>
      </tr>
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="64%"><select name="expte_esc_nro" id="expte_esc_nro">
<option value="0">Quitar expediente asignado</option>
<?	  while ($expte = mysql_fetch_array($sql567)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Barrio_nombre"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

?>
<option value="<? echo $expte_nro; ?>" <? if ($expte_nro == $familia["Expte_esc_nro"]) {echo "selected=\"selected\"";} ?>><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></option>
<? } ?>
</select></td>
        <td colspan="2"><input type="submit" name="Submit" value="Asignar" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>

    </table></td>
    <td width="390"><table width="360" border="0" cellpadding="5" cellspacing="0" bgcolor="#dedede">
      <tr>
        <td height="36" ></td>
        <td height="36" colspan="3" valign="bottom" style="font-size:14px; font-weight:bold;">Asignar barrio </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Seleccione el barrio correspondiente del siguiente listado. Aseg&uacute;rese seleccionar el barrio correcto (en el listado encontrar&aacute; cada barrio relacionado al partido correspondiente). </td>
        <td width="4%">&nbsp;</td>
      </tr>
      <tr>
        <td width="4%">&nbsp;</td>
        <td width="70%"><select name="barrio_nro" id="barrio_nro">
<option value="0">Seleccione un barrio</option>
<?	  while ($barrio = mysql_fetch_array($sql3)) {	

$barrio_nro = $expte["Barrio_nro"];
$barrio_partido = $barrio["Partido_nombre"];
$barrio_nombre = $barrio["Barrio_nombre"];
?>
<option value="<? echo $barrio_nro; ?>"><?=$barrio_partido; ?> - <?=$barrio_nombre; ?></option>
<? } ?>
</select></td>
        <td colspan="2"><input type="submit" name="Submit" value="Asignar" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<? 



?>