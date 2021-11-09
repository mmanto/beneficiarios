<?
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Anexo_altas.xls");
header("Pragma: no-cache");
header("Expires: 0");

include ("conec.php");



$idBarrio = $_GET["idBarrio"];

$res = "SELECT * FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Adjudicacion_pendiente = '1' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
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
<table>
	<tr>
	  	<td>Barrio: <?=$barrio_nombre; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td> 
	  </tr>
	  <tr>
	  	<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td> 
	  </tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="3">
	  <tr>
        <th height="30"><strong>Mz. Def.</strong></th>
	  <th><strong>Pc.</strong></th>
      <th><strong>Apellido, nombre y documento </strong></td>
      <th>Sup. (m2) </td>
      <th>Sup. com&uacute;n (m2) </th>
      <th>Sup. total (m2) </th>
      <th>Valor m2 </th>
      <th>Valor tierra ($) </th>
      <th>Valor mensura ($) </th>
      <th>Valor total ($) </th>
      <th>Cant cuotas </th>
      <th>Valor cuota ($) </th>
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
      <td align="center"><?=$familia["Lote_m2_valor_actual"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Lote_tierra_valor"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Lote_mensura_valor"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj_cuotas"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj_cuota_valor"]; ?>&nbsp;</td>
      </tr>
  <?
}
?>
    </table>
