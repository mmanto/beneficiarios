<?
include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$idBarrio = $_GET["idBarrio"];

$res = "SELECT * FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Adjudicacion_pendiente = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
$sql = mysql_query($res); 
$cant = mysql_num_rows($sql);

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre, Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql3);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];

$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);

?>
<table width="1080" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h1>Adjudicaci&oacute;n - Anexo altas  </h1></td>
  </tr>
  <tr>
    <td height="20"><a href="javascript:window.history.back();">[Volver al listado]</a></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <? echo $barrio_nombre ?>&nbsp;(<?=$cant; ?> lotes)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="38" height="30" align="center" class="titulo_dato"><strong>Mz. Prov.</strong></td>
	  <td width="42" height="30" align="center" class="titulo_dato"><strong>Mz. Def.</strong></td>
	  <td width="29" align="center" class="titulo_dato"><strong>Pc.</strong></td>
      <td width="252" align="center" class="titulo_dato"><strong>Apellido, nombre y documento </strong></td>
      <td width="60" align="center" class="titulo_dato">Sup. (m2) </td>
      <td width="73" align="center" class="titulo_dato">Sup. com&uacute;n (m2) </td>
      <td width="63" align="center" class="titulo_dato">Sup. total (m2) </td>
      <td width="56" align="center" class="titulo_dato">Valor m2 </td>
      <td width="67" align="center" class="titulo_dato">Valor tierra ($) </td>
      <td width="66" align="center" class="titulo_dato">Valor mensura ($) </td>
      <td width="63" align="center" class="titulo_dato">Valor total ($) </td>
      <td width="44" align="center" class="titulo_dato">Cant cuotas </td>
      <td width="57" align="center" class="titulo_dato">Valor cuota ($) </td>
      <td width="56" align="center" class="titulo_dato">Resol.</td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($sql)) {


$manzana_prov = $familia["Lote_manzana_prov"];
if ($manzana_prov == '0') { $manzana_prov = '-'; }
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];


$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1'",$link);
?>
      <tr>
        <td align="center"><? echo $manzana_prov; ?></td>
		<td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="82%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="18%"><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
        </tr>
        <? } ?>
        </table>	</td>
      <td align="center"><?=$familia["Lote_superficie"]; ?></td>
      <td align="center"><?=$familia["Lote_sup_comun"]; ?></td>
      <td align="center"><?=$familia["Lote_sup_total"]; ?></td>
      <td align="center"><?=$familia["Lote_m2_valor_origen"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Lote_tierra_valor"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Lote_mensura_valor"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj_cuotas"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj_cuota_valor"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_res_adj"]; ?>&nbsp;</td>
      </tr>
  <?
}
?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? include("pie.php"); ?>
