<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema de Expedientes</title>
<style type="text/css">
<!--
body {
	margin-left: 30px;
	margin-top: 10px;
}

h1 {
	font-size: 18px;
	font-weight:bold;
	margin: 0px;
	line-height: 16px;
}
h2 {
	font-size: 16px;
	font-weight:bold;
	margin: 0px;
	line-height: 14px;
}
</style>

<link href="estilos-impresion.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {font-weight: normal}
-->
</style>
</head>

<body onLoad="window.print()">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/logo-ba3.jpg" width="800" height="70" /></td>
  </tr>
</table>
<?

include ("conec.php");
include ("funciones.php");

$remito_nro = $_GET["idRemito"];


$sql3 = "SELECT * FROM (
dbo_exptesmov_remitos
INNER JOIN
dbo_usuarios
ON dbo_exptesmov_remitos.idUsuario = dbo_usuarios.idUsuario
) WHERE Remito_nro = $remito_nro";

$res3 = mysql_query($sql3);

$remito = mysql_fetch_array($res3);

$remito_num = $remito["Remito_nro"];

//$remito_anio = $remito["Remito_anio"];

$remito_fecha = cambiaf_a_normal($remito["Remito_fecha"]);

$remito_hora = $remito["Remito_hora"];

$remito_observaciones = $remito["Expte_mov_obs"];

$remito_usuario = $remito["Nombre"];

//Originante

$area_origen = $remito["Remito_area_origen"];
$res5 = mysql_query("SELECT Area_nombre FROM dbo_area WHERE Area_nro = '$area_origen'");
$origen = mysql_fetch_array($res5);
$remito_origen = $origen["Area_nombre"];

//Destinatario

$area_destino = $remito["Remito_area_destino"];
$res6 = mysql_query("SELECT Area_nombre FROM dbo_area WHERE Area_nro = '$area_destino'");
$destino = mysql_fetch_array($res6);
$remito_destino = $destino["Area_nombre"];


$sql = "SELECT * FROM dbo_exptes_mov WHERE Remito_nro = $remito_nro";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

?>

<table width="800" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <td width="201" align="center">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="right" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" align="center">&nbsp;</td>
    <td width="354" align="center" valign="middle"><h1>REMITO MOVILIZADO </h1></td>
    <td width="221" align="right" valign="bottom" bgcolor="#E4E4E4" style="border: 2px solid #000000" ><table width="100%" border="0" cellpadding="8" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="16" align="right"><h2>N&ordm;</h2></td>
        <td width="182" align="right"><h2><?=$remito_num; ?></h2></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40" colspan="3" align="right">     <h2><?=$remito_fecha;?> @<?=$remito_hora; ?>
    </h2></td>
  </tr>
  <tr>
    <td height="24" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="60%"><strong><u>Remitente:</u></strong></td>
        <td width="40%"><strong><u>Usuario:</u></strong></td>
      </tr>
      <tr>
        <td height="30">
		<? if ($remito["Expte_mov_reingreso"] == '1') { echo "<strong>Reingreso de expedientes al organismo</strong>";}else{ echo $remito_origen; } ?>&nbsp;</td>
        <td><?=$remito_usuario; ?>&nbsp;</td>
      </tr>

      <tr>
        <td><strong><u>Destinatario:</u></strong></td>
        <td><strong><u>Observaciones:</u></strong></td>
      </tr>
      <tr>
        <td height="30"><?=$remito_destino; ?>&nbsp;</td>
        <td><?=$remito_observaciones; ?>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="70" colspan="3"><h2><u>Expedientes en pase (Cant: <?=$cant; ?>, incluye exptes. agregados)</u> </h2></td>
  </tr>
  

<tr>
	<td height="680" colspan="3" align="right" valign="top">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td height="28" colspan="2" align="left" valign="top" style="border-bottom: #000000 3px solid;"><strong>Caract.</strong></td>
  <td style="border-bottom: #000000 3px solid;" width="9%" align="center" valign="top"><strong>Partido</strong></td>
  <td style="border-bottom: #000000 3px solid;" width="8%" align="center" valign="top"><strong>Reg.</strong></td>
  <td style="border-bottom: #000000 3px solid;" width="9%" align="center" valign="top"><strong>N&uacute;mero</strong></td>
  <td style="border-bottom: #000000 3px solid;" width="8%" align="center" valign="top"><strong>A&ntilde;o</strong></td>
  <td style="border-bottom: #000000 3px solid;" width="7%" align="center" valign="top"><strong>Alc.</strong></td>
  <td style="border-bottom: #000000 3px solid;" width="10%" align="center" valign="top"><strong>Cpos.</strong></td>
  <td style="border-bottom: #000000 3px solid;" width="31%" align="left" valign="top"><strong>Iniciado por </strong></td>
  <td width="8%" align="center" valign="top" style="border-bottom: #000000 3px solid;"><strong>Alta</strong></td>
  </tr>
<?
while ($mov = mysql_fetch_array($res)) {

$exptenro = $mov["Expte_nro"];

$sql2 = "SELECT * FROM (
dbo_exptes
INNER JOIN
dbo_area
ON dbo_exptes.Expte_origen = dbo_area.Area_nro
) WHERE Expte_nro = $exptenro AND blnActivo = '1'";

//$sql2 = "SELECT * FROM dbo_exptes WHERE Expte_nro = $exptenro";


$res2 = mysql_query($sql2);


$expte = mysql_fetch_array($res2);

$expte_caract = $expte["Expte_caract"];
$expte_partido = $expte["Expte_partido"];
$expte_rnrd = $expte["Expte_rnrd"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpos = $expte["Expte_cuerpos_cant"];
$expte_extracto = $expte["Expte_extracto"];
$origen = $expte["Area_nombre"];
$fecha_alta = cambiaf_a_normal($expte["Expte_alta_fecha"]);
$expte_padre = $expte["Expte_padre"];

if($expte_padre != '0') { 

$res7 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_nro = '$expte_padre'");
$expteAgr = mysql_fetch_array($res7);

?>
<tr>
<td height="26" colspan="10"><strong>EXPEDIENTE AGREGADO AL <? echo $expteAgr["Expte_caract"];
if($expteAgr["Expte_partido"] != '0') { echo "-".$expteAgr["Expte_partido"]; }
if($expteAgr["Expte_rnrd"] != '0') { echo "-".$expteAgr["Expte_rnrd"]; }
echo "-".$expteAgr["Expte_num"]."/".$expteAgr["Expte_anio"]." Alc. ".$expteAgr["Expte_alcance"]."; "; ?> </strong></td>
</tr>	
<? } ?>
<tr>
    <td height="26" colspan="2">
	<? if ($expte["Expte_ley_cons"]=='1'){ echo "<strong>(C)</strong>"; } ?>
	<? echo $expte_caract; ?> </td>
    <td align="center"><?=$expte_partido; ?>&nbsp;</td>
    <td align="center"><?=$expte_rnrd; ?>&nbsp;</td>
    <td align="center"><?=$expte_num; ?></td>
    <td align="center"><?=$expte_anio; ?></td>
    <td align="center"><?=$expte_alcance; ?>&nbsp;</td>
    <td align="center"><?=$expte_cuerpos; ?>&nbsp;</td>
    <td><?=$origen; ?>&nbsp;</td>
    <td><?=$fecha_alta; ?>&nbsp;</td>
</tr>
<tr>
  <td height="24" colspan="10" style="border-bottom: #999999 1px solid;"><strong>Extracto:</strong> <? echo $expte_extracto; ?></td>
  </tr>
<?  } ?>
</table>	</td>
  </tr>
<tr>
  <td colspan="3" align="right" valign="bottom" class="Estilo1"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="8%">&nbsp;</td>
        <td width="42%" class="Estilo1">Firma y sello remitente </td>
        <td width="40%" align="right" class="Estilo1">Firma y sello receptor </td>
        <td width="10%">&nbsp;</td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="60" colspan="3" align="right" valign="bottom" class="Estilo1">&nbsp;</td>
  </tr>	
</table>
<? include("pie-imp.php"); ?>
