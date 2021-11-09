<?
include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idBarrio = $_GET["idBarrio"];

$res = "SELECT * FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
/*
$res = "SELECT * FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Adjudicacion_pendiente = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
*/

$sql = mysql_query($res); 
$cant = mysql_num_rows($sql);

$sql3 = mysql_query("SELECT * FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql3);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];

$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);

$res2 = mysql_query("SELECT Familia_nro FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND blnActivo = '1'");
$cant2 = mysql_num_rows($res2);

?>
<form method="post" action="valores-asigna.php">
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8"><h1>Asignar valores </h1></td>
  </tr>
  <tr>
    <td colspan="8" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <? echo $barrio_nombre ?></td>
  </tr>
  <tr>
    <td height="50" colspan="8"><a href="javascript:window.history.back();">[Volver] </a></td>
  </tr>
  <tr>
    <td colspan="4" rowspan="3"><p>&nbsp;</p></td>
    <td width="154" rowspan="3">&nbsp;</td>
    <td width="146" rowspan="3">&nbsp;</td>
    <td height="26">&nbsp;</td>
    <td width="367" rowspan="3" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="13">
      <tr>
        <td bgcolor="#FFFF99" style="border: 2px solid #FFCC99;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3">Atenci&oacute;n: En todos los casos usar el punto como separador de decimales y <strong>NO </strong>como separador de  miles. Ejemplo: </td>
            </tr>
          <tr>
            <td width="48%" height="28" align="right" valign="bottom" style="font-size:16px">13.248,36</td>
            <td width="3%" align="center" valign="bottom" style="font-size:16px">&nbsp;</td>
            <td width="49%" valign="bottom" style="font-size:16px; color:#FF0000;" ><strong>&raquo; Incorrecto</strong></td>
            </tr>
          <tr>
            <td height="20" align="right" valign="bottom" style="font-size:16px"><strong>13248.36</strong></td>
            <td height="20" align="center" valign="bottom" style="font-size:16px">&nbsp;</td>
            <td height="26" valign="bottom" style="font-size:16px"><strong>&raquo; Correcto</strong></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="26">&nbsp;</td>
  </tr>
  <tr>
    <td width="213">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8"><table width="100%" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="42" align="center" class="titulo_dato"><strong>Circ.</strong></td>
        <td width="45" align="center" class="titulo_dato"><strong>Secc.</strong></td>
        <td width="45" align="center" class="titulo_dato"><strong>Ch.</strong></td>
        <td width="52" align="center" class="titulo_dato"><strong>Qta.</strong></td>
        <td width="57" height="30" align="center" class="titulo_dato"><strong>Mz. Prov.</strong></td>
	  <td width="62" height="30" align="center" class="titulo_dato"><strong>Mz. Def.</strong></td>
	  <td width="48" align="center" class="titulo_dato"><strong>Pc.</strong></td>
      <td width="303" align="center" class="titulo_dato"><strong>Apellido, nombre y documento </strong></td>
      <td width="108" align="center" class="titulo_dato"><strong>Valor</strong></td>
      <td width="56" align="center" class="titulo_dato"><strong>Cuotas</strong></td>
      </tr>
      
      
      
  <?
$i = 1;

while ($familia = mysql_fetch_array($sql)) {

$lote_circ = $familia["Lote_circunscripcion"];
if($familia["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $familia["Lote_seccion"];}
if($familia["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $familia["Lote_chacra"];}
if($familia["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $familia["Lote_quinta"];}
if($familia["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $familia["Lote_fraccion"];}
$manzana_prov = $familia["Lote_manzana_prov"];
if ($manzana_prov == '0') { $manzana_prov = '-'; }
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];
$lote_valor = $familia["Familia_montoadj"];
$lote_cuotas = $familia["Familia_montoadj_cuotas"];

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1'",$link);
?>
      <tr>
        <td align="center"><?=$lote_circ; ?></td>
        <td align="center"><?=$lote_secc; ?>&nbsp;</td>
        <td align="center"><?=$lote_ch; ?>&nbsp;</td>
        <td align="center"><?=$lote_qta; ?>&nbsp;</td>
        <td align="center"><? echo $manzana_prov; ?></td>
		<td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="73%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="27%"><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
        </tr>
        <? } ?>
        </table>	</td>
      <td align="center"><label>
        $
        <input name="lotevalor<?=$i ?>" type="text" size="8" value="<?=$lote_valor; ?>">
		<input type="hidden" name="id<?=$i ?>" value="<? echo $familia["Familia_nro"]; ?>" />
      </label></td>
      <td align="center"><label>
        <input name="lotecuotas<?=$i ?>" type="text" size="1" value="<?=$lote_cuotas; ?>">
		<input type="hidden" name="id<?=$i ?>" value="<? echo $familia["Familia_nro"]; ?>" />
      </label>
      </td>
      </tr>
  <?
$i++;
}
?>
    </table></td>
  </tr>
  <tr>
    <td height="30" colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" align="right"><label>
      <input name="cant" type="hidden" value="<?=$cant; ?>" />
	  <input name="idBarrio" type="hidden" value="<?=$idBarrio; ?>" />
      <input name="idPartido" type="hidden" value="<?=$barrio_partido; ?>" />
	  <input type="submit" name="Submit" value="Asignar valores" />
    </label></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? include("pie-imp.php"); ?>
