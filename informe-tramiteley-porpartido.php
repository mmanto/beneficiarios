<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");



$sqlPdo = "SELECT DISTINCT Tramite_partido FROM dbo_tramite_ley";
$resPdo = mysql_query($sqlPdo);



?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="900">
<tr>
    <td height="9" colspan="5"><h2>Estadística de trámites por año y partido iniciados en &quot;Respuesta Activa&quot;</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="5">El presentelistado refiere únicamente a trámites iniciados en el sector &quot;Respuesta Activa&quot; de la Subsecretaría de Hábitat de la Comunidad entre los años indicados en la primera columna.</td>
  </tr>
  <tr>
    <td height="25" colspan="5" valign="bottom"><a href="sbt-menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="5">&nbsp;</td>
  </tr>
</table>
<table width = "700">

<?

while ($partido = mysql_fetch_array($resPdo)) {
	
$partido_nro = 	$partido["Tramite_partido"];


$resPdoNmb = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = '$partido_nro'");
$partido2 = mysql_fetch_array($resPdoNmb);

$partido_nmb = $partido2["Partido_nombre"];


//////////////////////////

$sql = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2014%'";
$res = mysql_query($sql);
$cant1 = mysql_num_rows($res);

$sqlb = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2014%' AND Tramite_terminado = '1'";
$resb = mysql_query($sqlb);
$cant1b = mysql_num_rows($resb);

////////////////////////*

$sql2 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2015%'";
$res2 = mysql_query($sql2);
$cant2 = mysql_num_rows($res2);

$sql2b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2015%' AND Tramite_terminado = '1'";
$res2b = mysql_query($sql2b);
$cant2b = mysql_num_rows($res2b);

////////////////////////*

$sql3 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2016%'";
$res3 = mysql_query($sql3);
$cant3 = mysql_num_rows($res3);

$sql3b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2016%' AND Tramite_terminado = '1'";
$res3b = mysql_query($sql3b);
$cant3b = mysql_num_rows($res3b);

////////////////////////*

$sql4 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2017%'";
$res4 = mysql_query($sql4);
$cant4 = mysql_num_rows($res4);


$sql4b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2017%' AND Tramite_terminado = '1'";
$res4b = mysql_query($sql4b);
$cant4b = mysql_num_rows($res4b);


////////////////////////*

$sql5 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2018%'";
$res5 = mysql_query($sql5);
$cant5 = mysql_num_rows($res5);

$sql5b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2018%' AND Tramite_terminado = '1'";
$res5b = mysql_query($sql5b);
$cant5b = mysql_num_rows($res5b);

////////////////////////*

$sql6 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2019%'";
$res6 = mysql_query($sql6);
$cant6 = mysql_num_rows($res6);

$sql6b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2019%' AND Tramite_terminado = '1'";
$res6b = mysql_query($sql6b);
$cant6b = mysql_num_rows($res6b);

///////////////////////*

$sql7 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2020%'";
$res7 = mysql_query($sql7);
$cant7 = mysql_num_rows($res7);

$sql7b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2020%' AND Tramite_terminado = '1'";
$res7b = mysql_query($sql7b);
$cant7b = mysql_num_rows($res7b);


///////////////////////*

$sql8 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2021%'";
$res8 = mysql_query($sql8);
$cant8 = mysql_num_rows($res8);

$sql8b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_partido = '$partido_nro' AND Tramite_inicio_fecha LIKE '%2021%' AND Tramite_terminado = '1'";
$res8b = mysql_query($sql8b);
$cant8b = mysql_num_rows($res8b);


?>
<tr><td height="18"></td></tr>
<tr>
  <td>
<table width="500" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
<tr>
    <td height="35" colspan="3" align="center"><strong><?=$partido_nmb; ?>
    </strong></td>
  </tr>
  <tr>
    <td width="163" height="35" align="center">Año</td>
    <td width="237" align="center">Iniciadas</td>
    <td width="200" align="center">Completadas</td>
  </tr>
  <tr>
    <td height="26" align="center">2014</td>
    <td align="center"><? echo $cant1; ?>&nbsp;</td>
    <td align="center"><? echo $cant1b; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="center">2015</td>
    <td align="center"><? echo $cant2; ?>&nbsp;</td>
    <td align="center"><? echo $cant2b; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="center">2016</td>
    <td align="center"><? echo $cant3; ?>&nbsp;</td>
    <td align="center"><? echo $cant3b; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="center">2017</td>
    <td align="center"><? echo $cant4; ?>&nbsp;</td>
    <td align="center"><? echo $cant4b; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="center">2018</td>
    <td align="center"><? echo $cant5; ?>&nbsp;</td>
    <td align="center"><? echo $cant5b; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="center">2019</td>
    <td align="center"><? echo $cant6; ?>&nbsp;</td>
    <td align="center"><? echo $cant6b; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="center">2020</td>
    <td align="center"><? echo $cant7; ?>&nbsp;</td>
    <td align="center"><? echo $cant7b; ?>&nbsp;</td>
  </tr>
    <tr>
    <td height="26" align="center">2021</td>
    <td align="center"><? echo $cant8; ?>&nbsp;</td>
    <td align="center"><? echo $cant8b; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="center"><strong>Total</strong></td>
    <td height="26" align="center">
    <?
	$total = $cant1 + $cant2 + $cant3 + $cant4 + $cant5 + $cant6 + $cant7 + $cant8;
	echo "<strong>".$total."</strong>"; ?>
    
    &nbsp;</td>
    <td height="26" align="center">
    <?
	$totalb = $cant1b + $cant2b + $cant3b + $cant4b + $cant5b + $cant6b + $cant7b + $cant8b;
	echo "<strong>".$totalb."</strong>"; ?>
    
    &nbsp;</td>
  </tr>
 </table>
 </td></tr></tr>
<? } ?>  
</table>
</body>
</html>
