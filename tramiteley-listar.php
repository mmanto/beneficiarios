<?php

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

?>

<table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="75" height="35" align="center" bgcolor="#CDD6DE"><strong>Fecha </strong></td>
    <td width="122" align="center" bgcolor="#CDD6DE"><strong>Nomenc</strong></td>
    <td width="177" align="center" bgcolor="#CDD6DE"><strong>Nombre</strong></td>
    <td width="199" align="center" bgcolor="#CDD6DE"><strong>DNI</strong></td>
    <td width="55" align="center" bgcolor="#CDD6DE"><strong>C&eacute;dula</strong></td>
    <td width="60" align="center" bgcolor="#CDD6DE"><strong>Planch</strong></td>
    <td width="55" align="center" bgcolor="#CDD6DE"><strong>Inf. Dom </strong></td>
    <td width="46" align="center" bgcolor="#CDD6DE"><strong>Edicto</strong></td>
	<td width="61" align="center" bgcolor="#CDD6DE"><strong>C&aacute;mara</strong></td>
  </tr>

<?
$sql = "SELECT * FROM dbo_tramite_ley ORDER BY Tramite_nro LIMIT 0,500";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

$num_fila = 1;

while ($tramite = mysql_fetch_array($res)) {

$tramite_nro = $tramite["Tramite_nro"];

$cedula = $tramite["Tramite_cedula"];
$plancheta = $tramite["Tramite_plancheta"];
$infdom = $tramite["Tramite_inf_dom"];
$edicto = $tramite["Tramite_edicto"];
$camara = $tramite["Tramite_inf_camara"];




$sql2 = "SELECT * FROM dbo_persona WHERE Tramite_nro = $tramite_nro";
$res2 = mysql_query($sql2);

$persona = mysql_fetch_array($res2);
$personac1doc = $persona["Persona_dni_nro"];


?>
<tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DDDDDD\""; } ?>>
    <td height="28" align="center"><? echo $tramite["Tramite_inicio_fecha"]; ?>&nbsp;</td>
    <td align="center"><? echo $tramite["Tramite_nomenc"]; ?></td>
    <td><? echo $persona["Persona_apellido"]; ?>, <? echo $persona["Persona_nombre"] ?>&nbsp;</td>
    <td align="center"><? echo $personac1doc; ?> &nbsp;</td>
	<td align="center"><? echo $cedula; ?></td>
    <td align="center"><? echo $plancheta; ?></td>
    <td align="center"><? echo $infdom; ?></td>
    <td align="center"><? echo $edicto; ?></td>
	<td align="center"><? echo $camara; ?>
	</td>
  </tr>
<?
$num_fila++;
} 

?>
<tr><td height="60" colspan="9" align="right">&nbsp;</td>
</tr>
</table>