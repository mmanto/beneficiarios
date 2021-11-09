<?
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);

$idBarrio = $_POST["idBarrio"];

$lista = implode(',',$_POST['seleccion']);

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre, Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql3);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];

$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);


$sql = "SELECT * FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Familia_nro IN(".$lista.") AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


$res = mysql_query($sql);

$cant = mysql_num_rows($res);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema de Expedientes</title>
<style type="text/css">
<!--
body {
	margin-left: 30px;
	margin-top: 20px;
}
</style>

<link href="estilos-impresion.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="window.print()">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/logo-ba3.jpg" alt="Buenos Aires" width="800" height="70" /></td>
  </tr>
</table>
<style type="text/css">
<!--
.Estilo2 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 14px}
-->
</style>





<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="60" colspan="2" align="center"><h1>CERTIFICADO DE CANCELACIÓN</h1></td>
  </tr>
  <tr>
    <td width="23" height="30" align="center" bgcolor="#999999" style="font-size:18px;"><a href="javascript:window.history.back();">&laquo;</a>&nbsp;</td>
    <td width="777" style="font-size:18px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Certifico que los adjudicatarios consignados en el listado que a contiuación se detalla, han cancelado el precio total del terreno convenido en el marco del programa del Decreto 2225/95 ubicados en el barrio <strong><? echo $barrio_nombre ?></strong> del Partido de <strong><?=$partido["Partido_nombre"]; ?>.</strong></td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:window.history.back()">Volver</a></td>
  </tr>
  <tr>
    <td height="28" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td height="25" colspan="2">
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
	<table width="800" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="33" align="center" class="titulo_dato">Circ.</td>
        <td width="40" align="center" class="titulo_dato">Secc.</td>
        <td width="29" align="center" class="titulo_dato">Mz. Prov.</td>
        <td width="30" align="center" class="titulo_dato">Pc. Prov.</td>
        <td width="28" height="30" align="center" class="titulo_dato">Mz. Def.</td>
	  <td width="24" align="center" class="titulo_dato">Pc. Def.</td>
      <td width="350" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="89" align="center" class="titulo_dato">Res. Adj.</td>
      <td width="103" align="center" class="titulo_dato">Precio</td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

$lote_circ = $familia["Lote_circunscripcion"];
if($familia["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $familia["Lote_seccion"];}
if($familia["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $familia["Lote_chacra"];}
if($familia["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $familia["Lote_quinta"];}
if($familia["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $familia["Lote_fraccion"];}
//
if($familia["Lote_manzana_prov"]=='0'){$lote_mz_prov = " - ";}else{$lote_mz_prov = $familia["Lote_manzana_prov"];}

if($familia["Lote_parcela_prov"]=='0'){$lote_pc_prov = " - ";}else{$lote_pc_prov = $familia["Lote_parcela_prov"];}
//


$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];

if($familia["Lote_manzana_prov"]=='0'){$lote_manzana_prov = " - ";}else{$lote_manzana_prov = $familia["Lote_manzana_prov"];}


if($familia["Lote_parcela_prov"]=='0'){$lote_parcela_prov = " - ";}else{$lote_parcela_prov = $familia["Lote_parcela_prov"];}

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1'",$link);
?>
      <tr>
        <td align="center"><? echo $lote_circ; ?></td>
        <td align="center"><? echo $lote_secc; ?>&nbsp;</td>
        <td align="center"><? echo $lote_mz_prov; ?>&nbsp;</td> 
        <td align="center"><? echo $lote_pc_prov; ?>&nbsp;</td>
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
      <td align="center">$ <?=$familia["Familia_montoadj"] ?></td>
      </tr>
  <?
}
?>
    </table>
	<? } ?></td>
  </tr>
  <tr>
    <td height="25" colspan="2">&nbsp;</td>
  </tr>
</table>
