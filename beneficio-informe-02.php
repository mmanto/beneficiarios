<?
include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$idBarrio = $_GET["idBarrio"];

$res = "SELECT * FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Adjudicacion_pendiente = '1' AND Familia_doc_completa = '1' AND Familia_censo_ausente = '0' AND Familia_ocupacion_verificar = '0' AND Familia_conflicto = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
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
<table width="812" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="812"><h1>Listado de ocupantes </h1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
        <td width="44" align="center" class="titulo_dato"><strong>Circ.</strong></td>
        <td width="47" align="center" class="titulo_dato"><strong>Secc.</strong></td>
        <td width="47" align="center" class="titulo_dato"><strong>Ch.</strong></td>
        <td width="48" align="center" class="titulo_dato"><strong>Qta.</strong></td>
        <td width="68" height="30" align="center" class="titulo_dato"><strong>Mz. Prov.</strong></td>
        <td width="60" height="30" align="center" class="titulo_dato"><strong>Mz. Def.</strong></td>
        <td width="49" align="center" class="titulo_dato"><strong>Pc.</strong></td>
        <td width="371" align="center" class="titulo_dato"><strong>Apellido, nombre y documento </strong></td>
        </tr>
      
      
      
      <?


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
            <td width="82%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
            <td width="18%"><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
            </tr>
          <? } ?>
          </table>	</td>
        </tr>
      <?
}
?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? include("pie-imp.php"); ?>
