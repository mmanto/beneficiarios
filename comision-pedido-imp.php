<?
include ("conec.php");
require ("funciones.php");

$idComision = $_GET["idComision"];

$sql = "SELECT * FROM (
dbo_comisiones
INNER JOIN
dbo_partido
ON dbo_comisiones.Partido_nro = dbo_partido.Partido_nro
INNER JOIN
dbo_comision_estado
ON dbo_comisiones.Comision_estado = dbo_comision_estado.Comision_estado_nro
INNER JOIN
dbo_area
ON dbo_comisiones.Comision_area = dbo_area.Area_nro
) WHERE Comision_nro = $idComision";

$res = mysql_query($sql);
$comision = mysql_fetch_array($res);



$sql2 = "SELECT * FROM (
dbo_comision_agentes
INNER JOIN
dbo_agentes
ON dbo_comision_agentes.Agente_nro = dbo_agentes.agente_nro
) WHERE Comision_nro = $idComision";
$res2 = mysql_query($sql2);
$cant = mysql_num_rows($res2);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema de Expedientes</title>
<style type="text/css">
<!--
body {
	margin-left: 50px;
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
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="100" colspan="3" align="center"><h2>SOLICITUD DE VEHÍCULO Y PEDIDO DE COMISION</h2></td>
  </tr>
  <tr>
    <td height="50" colspan="3" align="right"><strong>DÍA DE SOLICITUD:</strong> <? echo cambiaf_a_normal($comision["Comision_alta_fecha"]) ?></td>
  </tr>
  <tr>
    <td height="35" colspan="2"><strong>FECHA DE COMISIÓN: </strong> <? echo cambiaf_a_normal($comision["Comision_fecha"]) ?></td>
    <td height="35"><strong>CANT. D&Iacute;AS:</strong> <?=$comision["Comision_dias_cant"]; ?></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>HORA DE SALIDA: <?=$comision["Comision_hora_salida"]; ?></strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>MUNICIPIO: </strong><?=$comision["Partido_nombre"]; ?> <strong>BARRIO:</strong> <?=$comision["Comision_barrio"]; ?></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>DOMICILIO DESTINO:</strong>
    <?=$comision["Comision_domicilio"]; ?></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>MOTIVO:</strong> <?=$comision["Comision_motivo"]; ?></td>
  </tr>
  <tr>
    <td height="35"><strong>CONVENIO:</strong></td>
    <td width="257">&nbsp;</td>
    <td width="407"><strong>LEY 24374:</strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>VIÁTICO PRESUP.:</strong></td>
  </tr>
  <tr>
    <td height="60" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="21%" valign="top"><strong>INTEGRANTES (<?=$cant; ?>):</strong></td>
        <td width="79%" valign="top"><? while($agente = mysql_fetch_array($res2)) { ?> 
      <? echo strtoupper($agente["agente_apellido"]).", ".$agente["agente_nombre"]; ?> -
      <? } ?>
      
    &nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>DÍAS ASIGNADOS:</strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>DÍAS ABONADOS:</strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>DEPARTAMENTO: <?=$comision["Area_nombre"]; ?></strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>VEHÍCULO ASIGNADO:</strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>CHOFER:</strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>PASAJE OFICIAL:</strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>OTROS:</strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3"><strong>OBSERVACIONES:</strong></td>
  </tr>
  <tr>
    <td height="130" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="40" colspan="3"><table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="247" height="3" align="center">.................................................</td>
        <td width="26"></td>
        <td width="248" align="center">.................................................</td>
        <td width="29"></td>
        <td width="250">.................................................</td>
      </tr>
      <tr>
        <td height="28" align="center">Jefe Departamento</td>
        <td>&nbsp;</td>
        <td align="center">Director</td>
        <td>&nbsp;</td>
        <td align="center">Director Provincial</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="95" colspan="3">&nbsp;</td>
  </tr>
</table>

<?  

include("pie.php");

?>