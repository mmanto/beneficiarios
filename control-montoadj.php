<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$sql = "SELECT * FROM dbo_tarjeta WHERE Tarjeta_monto_origen !=0 ORDER BY Tarjeta_nro";

$res = mysql_query($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<h1>Detalle tarjeta lote</h1>
<table width="700" border="0" cellspacing="7" cellpadding="0">
  <tr>
    <td width="88" height="35" align="center"><strong>Tarjeta</strong></td>
    <td width="76" align="center"><strong>Familia Nro.</strong></td>
    <td width="120" align="center"><strong>Monto orig. s/dbo_tarjeta</strong></td>
    <td width="117" align="center"><strong>Monto orig s/dbo_familia</strong></td>
    <td width="114" align="center">Monto actual s/dbo_tarjeta</td>
    <td width="102" align="center">Monto actual s/dbo_familia</td>
    <td width="59" align="center">&nbsp;</td>
  </tr>
<? while($tarjeta = mysql_fetch_array($res)) { 

$tarjeta_nro = $tarjeta["Tarjeta_nro"];
$tarjeta_montoadj = $tarjeta["Tarjeta_monto_origen"];
$tarjeta_montoactual = $tarjeta["Tarjeta_monto_actual"];

$persona_nro = $tarjeta["Persona_nro"];

$sql2 = "SELECT Persona_nro, Familia_nro FROM dbo_persona WHERE Persona_nro = $persona_nro";
$res2 = mysql_query($sql2);
$persona = mysql_fetch_array($res2);

$familia_nro = $persona["Familia_nro"];

$sql3 = "SELECT * FROM dbo_familia WHERE Familia_nro = $familia_nro";
$res3 = mysql_query($sql3);
$familia = mysql_fetch_array($res3);

$familia_montoadj = $familia["Familia_montoadj"];
$familia_montoactual = $familia["Familia_monto_actualizacion"];



?> 
  <tr>
    <td height="22" align="center"><? echo $tarjeta_nro; ?>&nbsp;</td>
    <td align="center"><? echo $familia_nro; ?>&nbsp;</td>
    <td align="center" bgcolor="#DBE7D3"><? echo $tarjeta_montoadj; ?>&nbsp;</td>
    <td align="center"><? echo $familia_montoadj; ?>&nbsp;</td>
    <td align="center" bgcolor="#E1E1E1"><? echo $tarjeta_montoactual; ?>&nbsp;</td>
    <td align="center" bgcolor="#E1E1E1"><? echo $familia_montoactual; ?>&nbsp;</td>
    <td align="center">
<? if ($tarjeta_montoadj > $familia_montoadj) {echo "MAYOR"; }elseif($tarjeta_montoadj < $familia_montoadj) { echo "Menor"; }else{ echo "===="; }  ?>


  &nbsp;</td>
  </tr>
<? } ?> 
</table>
</body>
</html>