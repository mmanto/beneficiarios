<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


/////////////

$sql = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2014%'";
$res = mysql_query($sql);
$cant1 = mysql_num_rows($res);

$sqlb = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2014%' AND Tramite_terminado = '1'";
$resb = mysql_query($sqlb);
$cant1b = mysql_num_rows($resb);

$sqlc = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2014%' AND Tramite_archivado = '1'";
$resc = mysql_query($sqlc);
$cant1c = mysql_num_rows($resc);

$EnTr1 = $cant1 - $cant1c;  


////////////////////////*

$sql2 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2015%'";
$res2 = mysql_query($sql2);
$cant2 = mysql_num_rows($res2);

$sql2b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2015%' AND Tramite_terminado = '1'";
$res2b = mysql_query($sql2b);
$cant2b = mysql_num_rows($res2b);

$sql2c = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2015%' AND Tramite_archivado = '1'";
$res2c = mysql_query($sql2c);
$cant2c = mysql_num_rows($res2c);

$EnTr2 = $cant2 - $cant2c;  


////////////////////////*

$sql3 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2016%'";
$res3 = mysql_query($sql3);
$cant3 = mysql_num_rows($res3);

$sql3b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2016%' AND Tramite_terminado = '1'";
$res3b = mysql_query($sql3b);
$cant3b = mysql_num_rows($res3b);


$sql3c = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2016%' AND Tramite_archivado = '1'";
$res3c = mysql_query($sql3c);
$cant3c = mysql_num_rows($res3c);

$EnTr3 = $cant3 - $cant3c;  


////////////////////////*

$sql4 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2017%'";
$res4 = mysql_query($sql4);
$cant4 = mysql_num_rows($res4);


$sql4b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2017%' AND Tramite_terminado = '1'";
$res4b = mysql_query($sql4b);
$cant4b = mysql_num_rows($res4b);


$sql4c = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2017%' AND Tramite_archivado = '1'";
$res4c = mysql_query($sql4c);
$cant4c = mysql_num_rows($res4c);

$EnTr4 = $cant4 - $cant4c; 


////////////////////////*

$sql5 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2018%'";
$res5 = mysql_query($sql5);
$cant5 = mysql_num_rows($res5);

$sql5b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2018%' AND Tramite_terminado = '1'";
$res5b = mysql_query($sql5b);
$cant5b = mysql_num_rows($res5b);

$sql5c = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2018%' AND Tramite_archivado = '1'";
$res5c = mysql_query($sql5c);
$cant5c = mysql_num_rows($res5c);

$EnTr5 = $cant5 - $cant5c; 

////////////////////////*

$sql6 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2019%'";
$res6 = mysql_query($sql6);
$cant6 = mysql_num_rows($res6);

$sql6b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2019%' AND Tramite_terminado = '1'";
$res6b = mysql_query($sql6b);
$cant6b = mysql_num_rows($res6b);

$sql6c = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2019%' AND Tramite_archivado = '1'";
$res6c = mysql_query($sql6c);
$cant6c = mysql_num_rows($res6c);

$EnTr6 = $cant6 - $cant6c; 

///////////////////////*

$sql7 = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2020%'";
$res7 = mysql_query($sql7);
$cant7 = mysql_num_rows($res7);

$sql7b = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2020%' AND Tramite_terminado = '1'";
$res7b = mysql_query($sql7b);
$cant7b = mysql_num_rows($res7b);

$sql7c = "SELECT Tramite_nro FROM dbo_tramite_ley WHERE Tramite_inicio_fecha LIKE '%2020%' AND Tramite_archivado = '1'";
$res7c = mysql_query($sql7c);
$cant7c = mysql_num_rows($res7c);

$EnTr7 = $cant7 - $cant7c; 





?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="800">
<tr>
    <td height="9" colspan="5"><h2>Reporte de trámites por año iniciados en &quot;Respuesta Activa&quot;</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="5">El presentelistado refiere únicamente a trámites iniciados en el sector &quot;Respuesta Activa&quot; de la Subsecretaría de Hábitat de la Comunidad entre los años indicados en la primera columna. La columna &quot;terminados&quot; refiere a cuántos trámites se completaron de la segunda columna.</td>
  </tr>
  <tr>
    <td height="25" colspan="5" valign="bottom"><a href="sbt-menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="5">&nbsp;</td>
  </tr>
</table>

<table width="700" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
  <tr>
    <td width="111" height="35" align="center">Año</td>
    <td width="136" align="center">Iniciados</td>
    <td width="110" align="center">Archivados</td>
    <td width="119" align="center">En trámite</td>
    <td width="104" align="center">Terminados</td>
    <td width="106" align="center">% terminado</td>
  </tr>
  <tr>
    <td height="26" align="center">2014</td>
    <td align="center"><? echo $cant1; ?>&nbsp;</td>
    <td align="center"><? echo $cant1c; ?>&nbsp;</td>
    <td align="center"><? echo $EnTr1; ?>&nbsp;</td>
    <td align="center"><? echo $cant1b; ?>&nbsp;</td>
    <td align="center"><?
	$div1 = ($cant1b/$EnTr1)*100;
    $porc1 = round($div1,1);
	echo $porc1; ?>&nbsp;%</td>
  </tr>
  <tr>
    <td height="26" align="center">2015</td>
    <td align="center"><? echo $cant2; ?>&nbsp;</td>
    <td align="center"><? echo $cant2c; ?>&nbsp;</td>
    <td align="center"><? echo $EnTr2; ?>&nbsp;</td>
    <td align="center"><? echo $cant2b; ?>&nbsp;</td>
    <td align="center"><?
	$div2 = ($cant2b/$EnTr2)*100;
    $porc2 = round($div2,1);
	echo $porc2; ?>&nbsp;%</td>
  </tr>
  <tr>
    <td height="26" align="center">2016</td>
    <td align="center"><? echo $cant3; ?>&nbsp;</td>
    <td align="center"><? echo $cant3c; ?>&nbsp;</td>
    <td align="center"><? echo $EnTr3; ?>&nbsp;</td>
    <td align="center"><? echo $cant3b; ?>&nbsp;</td>
    <td align="center"><?
	$div3 = ($cant3b/$EnTr3)*100;
    $porc3 = round($div3,1);
	echo $porc3; ?>&nbsp;%</td>
  </tr>
  <tr>
    <td height="26" align="center">2017</td>
    <td align="center"><? echo $cant4; ?>&nbsp;</td>
    <td align="center"><? echo $cant4c; ?>&nbsp;</td>
    <td align="center"><? echo $EnTr4; ?>&nbsp;</td>
    <td align="center"><? echo $cant4b; ?>&nbsp;</td>
    <td align="center"><?
	$div4 = ($cant4b/$EnTr4)*100;
    $porc4 = round($div4,1);
	echo $porc4; ?>&nbsp;%</td>
  </tr>
  <tr>
    <td height="26" align="center">2018</td>
    <td align="center"><? echo $cant5; ?>&nbsp;</td>
    <td align="center"><? echo $cant5c; ?>&nbsp;</td>
    <td align="center"><? echo $EnTr5; ?>&nbsp;</td>
    <td align="center"><? echo $cant5b; ?>&nbsp;</td>
    <td align="center"><?
	$div5 = ($cant5b/$EnTr5)*100;
    $porc5 = round($div5,1);
	echo $porc5; ?>&nbsp;%</td>
  </tr>
  <tr>
    <td height="26" align="center">2019</td>
    <td align="center"><? echo $cant6; ?>&nbsp;</td>
    <td align="center"><? echo $cant6c; ?>&nbsp;</td>
    <td align="center"><? echo $EnTr6; ?>&nbsp;</td>
    <td align="center"><? echo $cant6b; ?>&nbsp;</td>
    <td align="center"><?
	$div6 = ($cant6b/$EnTr6)*100;
    $porc6 = round($div6,1);
	echo $porc6; ?>&nbsp;%</td>
  </tr>
  <tr>
    <td height="26" align="center">2020</td>
    <td align="center"><? echo $cant7; ?>&nbsp;</td>
    <td align="center"><? echo $cant7c; ?>&nbsp;</td>
    <td align="center"><? echo $EnTr7; ?>&nbsp;</td>
    <td align="center"><? echo $cant7b; ?>&nbsp;</td>
    <td align="center"><?
	$div7 = ($cant7b/$EnTr7)*100;
    $porc7 = round($div7,1);
	echo $porc7; ?>&nbsp;%</td>
  </tr>
</table>
</body>
</html>
