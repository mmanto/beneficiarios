<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);

//Conurbano
$res1 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_conurbano = 1 ORDER BY Partido_nombre ASC");

//Interior
$res2 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_conurbano != 1 ORDER BY Partido_nombre ASC");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Informe general</title>
</head>

<body>

Conurbano
<table width="400" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="159">Partido</td>
    <td width="118" align="center">Escriturados</td>
    <td width="123" align="center">En tr&aacute;mite de escritura </td>
  </tr>
<? while ($Partido = mysql_fetch_array($res1)) { 

$idPartido = $Partido["Partido_nro"];

$sql5 = "SELECT COUNT(Familia_nro) FROM dbo_familia WHERE Partido_nro = $idPartido AND Familia_matricula != 0 AND blnActivo = '1'";
$res5 = mysql_query($sql5);
$count5 = mysql_fetch_array($res5);

$sql6 = "SELECT COUNT(Familia_nro) FROM dbo_familia WHERE Partido_nro = $idPartido AND Expte_esc_nro != 0 AND Familia_matricula = 0 AND blnActivo = '1'";
$res6 = mysql_query($sql6);
$count6 = mysql_fetch_array($res6);


?> 
  <tr>
    <td height="22"><?=$Partido["Partido_nombre"]; ?>&nbsp;</td>
    <td align="center"><? echo $count5[0]; ?>&nbsp;</td>
    <td align="center"><? echo $count6[0]; ?>&nbsp;</td>
  </tr>

<? } ?>


  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>



<p>&nbsp;</p>
<p>Interior</p>
<table width="400" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="159">Partido</td>
    <td width="118" align="center">Escriturados</td>
    <td width="123" align="center">En tr&aacute;mite de escritura </td>
  </tr>
<? while ($Partido = mysql_fetch_array($res2)) { 

$idPartido = $Partido["Partido_nro"];

$sql7 = "SELECT COUNT(Familia_nro) FROM dbo_familia WHERE Partido_nro = $idPartido AND Familia_matricula != 0 AND blnActivo = '1'";
$res7 = mysql_query($sql7);
$count7 = mysql_fetch_array($res7);

$sql8 = "SELECT COUNT(Familia_nro) FROM dbo_familia WHERE Partido_nro = $idPartido AND Expte_esc_nro != 0 AND Familia_matricula = 0 AND blnActivo = '1'";
$res8 = mysql_query($sql8);
$count8 = mysql_fetch_array($res8);


?> 
  <tr>
    <td height="22"><?=$Partido["Partido_nombre"]; ?>&nbsp;</td>
    <td align="center"><? echo $count7[0]; ?>&nbsp;</td>
    <td align="center"><? echo $count8[0]; ?>&nbsp;</td>
  </tr>

<? } ?>


  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
