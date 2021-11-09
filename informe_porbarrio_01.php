<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);

$idBarrio = $_GET["idBarrio"];

$criterio = $_GET["criterio"];

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre, Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql3);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];

$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);

if ($criterio == '1') {

$sql = "SELECT Familia_nro, Familia_apellido, Familia_res_adj, Familia_doc_completa, Familia_pagocancelado, Familia_cond_escrit, Familia_tramitependiente, Expte_esc_nro, Lote_manzana_prov, Familia_matricula, Familia_observaciones,  Nombre, Lote_manzana, Lote_parcela  FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Familia_matricula != '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '2') {

$sql = "SELECT Familia_nro, Familia_apellido, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela, Familia_res_adj, Familia_doc_completa, Lote_manzana_prov, Familia_pagocancelado, Familia_cond_escrit, Familia_observaciones, Familia_tramitependiente, Expte_esc_nro, Familia_matricula,  Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Expte_esc_nro != '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '3'){

$sql = "SELECT Familia_nro, Familia_apellido, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela,  Familia_res_adj, Familia_doc_completa, Lote_manzana_prov, Familia_pagocancelado, Familia_cond_escrit, Familia_observaciones, Familia_tramitependiente, Expte_esc_nro, Familia_matricula, Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Familia_cond_escrit = '1' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}else{

$sql = "SELECT Familia_nro, Familia_apellido, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela,  Familia_res_adj, Familia_doc_completa, Lote_manzana_prov, Familia_pagocancelado, Familia_observaciones, Familia_cond_escrit, Familia_tramitependiente, Expte_esc_nro, Familia_matricula, Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
}


$res = mysql_query($sql);

$cant = mysql_num_rows($res);



?><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h1>Informe de beneficiarios de tierras </h1></td>
  </tr>
  <tr>
    <td height="30" colspan="3" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <? echo $barrio_nombre ?></td>
  </tr>
  <tr>
    <td colspan="3">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="3" valign="bottom"><a href="beneficio_porbarrio_listar.php?idBarrio=<?=$idBarrio;?>&criterio=<?=$criterio; ?>">Volver al informe regular</a></td>
  </tr>
  <tr>
    <td height="8" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="70" height="8">Mostrando:</td>
    <td width="201"><form><select name="ListeUrl" onChange="ChangeUrl(this.form)">
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=0" <? if ($criterio == '0') { ?> selected="selected" <? } ?>>Todos</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=1" <? if ($criterio == '1') { ?> selected="selected" <? } ?>>Escriturados</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=2" <? if ($criterio == '2') { ?> selected="selected" <? } ?>>En tr&aacute;mite de escrituraci&oacute;n</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=3" <? if ($criterio == '3') { ?> selected="selected" <? } ?>>En condiciones de escriturar</option>
    </select>
    </form>    </td>
    <td width="630"><strong>(
      <?=$cant; ?> 
    resultados) </strong></td>
  </tr>
  <tr>
    <td height="28" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td height="25" colspan="3">
	<? if ($cant > 0) { ?>
	<table width="740" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="11%">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="24%">&nbsp;</td>
          <td width="4%">&nbsp;</td>
          <td width="19%">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="13%">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="17%">&nbsp;</td>
        </tr>
      </table>
	<table width="960" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="32" align="center" class="titulo_dato">Circ.</td>
        <td width="34" align="center" class="titulo_dato">Secc.</td>
        <td width="31" align="center" class="titulo_dato">Ch.</td>
        <td width="32" align="center" class="titulo_dato">Qta.</td>
        <td width="33" height="30" align="center" class="titulo_dato">Mz. Prov.</td>
	  <td width="28" height="30" align="center" class="titulo_dato">Mz. Def</td>
	  <td width="26" align="center" class="titulo_dato">Pc.</td>
      <td width="256" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="89" align="center" class="titulo_dato">Resolucion</td>
      <td width="84" align="center" class="titulo_dato">Matr&iacute;cula</td>
      <td width="225" align="center" class="titulo_dato">Observaciones</td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

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
          <td width="18%"><? echo $persona["Persona_dni_nro"]; ?></td>
        </tr>
        <? } ?>
        </table>	</td>
      <td align="center"><?=$familia["Familia_res_adj"] ?></td>
      <td align="center"><?=$familia["Familia_matricula"] ?></td>
      <td align="center"><?=$familia["Familia_observaciones"] ?></td>
      </tr>
  <?
}
?>
    </table>
	<? } ?></td>
  </tr>
  <tr>
    <td height="25" colspan="3">&nbsp;</td>
  </tr>
</table>
<? include "pie.php"; ?>