<?
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Anexo_bajas.xls");
header("Pragma: no-cache");
header("Expires: 0");

include ("conec.php");



$idBarrio = $_GET["idBarrio"];

$res = "SELECT * FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_conbajas = '1'AND Adjudicacion_pendiente = '1' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
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
	  	<td>Anexo Bajas</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
  </tr>
    <tr>
	  	<td>Barrio: <?=$barrio_nombre; ?></td>
	  </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
</table>
<table width="850" border="1" cellpadding="3" cellspacing="0">   
	  <tr>
	    <th width="57">Mz. Prov. </th>
        <th width="51" height="30"><strong>Mz. Def.</strong></th>
	  <th width="50"><strong>Pc.</strong></th>
      <th width="658"><strong>Apellido, nombre y documento </strong></td>	  </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($sql)) {


$manzana_prov = $familia["Lote_manzana_prov"];
if ($manzana_prov == '0') { $manzana_prov = '-'; }
$manzana = $familia["Lote_manzana"];
	if($familia["Lote_manzana_prov"] == '0') { $manzana_prov = '-'; }else{ $manzana_prov = $familia["Lote_manzana_prov"]; }
$parcela = $familia["Lote_parcela"];


$sql2 = mysql_query("SELECT * FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '1' AND (Persona_baja_resolucion = '0' OR length(Persona_baja_resolucion) = 0) AND blnActivo = '1'",$link);
?>
      <tr>
        <td align="center"><? echo $manzana_prov; ?>&nbsp;</td>
        <td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="55%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="19%" align="right"><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
          <td width="2%">&nbsp;</td>
          <td width="24%">Res. Alta: <?=$persona["Persona_baja_res_alta"]; ?></td>
        </tr>
        <? } ?>
        </table>	</td>
      </tr>
  <?
}
?>
</table>
