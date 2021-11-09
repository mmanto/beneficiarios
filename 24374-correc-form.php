<?php

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

?>
<form method="post" action="24374-correc.php">
<table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DDDDDD\""; }else{ echo "bgcolor=\"#E9E9E9\"";} ?>>
    <td width="75" height="35" align="center"><strong>Orden</strong></td>
    <td width="105" align="center"><strong>Nomenc</strong></td>
    <td width="224" align="center"><strong>Nombre</strong></td>
    <td width="169" align="center"><strong>DNI</strong></td>
    <td width="55" align="center"><strong>C&eacute;dula</strong></td>
    <td width="60" align="center"><strong>Planch</strong></td>
    <td width="55" align="center"><strong>Inf. Dom </strong></td>
    <td width="46" align="center"><strong>Edicto</strong></td>
	<td width="61" align="center"><strong>C&aacute;mara</strong></td>
  </tr>

<?
$sql = "SELECT * FROM dbo_tramite_ley WHERE Tramite_id_migra != '0' AND Corregido = '0' ORDER BY Tramite_nro LIMIT 0,50";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);


$i = 1;
$num_fila = 1;

while ($tramite = mysql_fetch_array($res)) {

$tramite_nro = $tramite["Tramite_nro"];

$cedula = $tramite["Tramite_cedula"];
$plancheta = $tramite["Tramite_plancheta"];
$infdom = $tramite["Tramite_inf_dom"];
$edicto = $tramite["Tramite_edicto"];
$camara = $tramite["Tramite_inf_camara"];

$sumac1 = $cedula+$plancheta+$infdom;

//$sumac1 = $cedula+$plancheta+$infdom+$edicto+$camara;


$sql2 = "SELECT * FROM dbo_persona WHERE Tramite_nro = $tramite_nro";
$res2 = mysql_query($sql2);

$persona = mysql_fetch_array($res2);
$personac1doc = $persona["Persona_dni_nro"];

//echo $personac1doc.$result."</br>";

?>
<tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DDDDDD\""; } ?>>
    <td height="28" align="center"><? echo $tramite_nro; ?>&nbsp;</td>
    <td align="center"><? echo $tramite["Tramite_nomenc"]; ?></td>
    <td><? echo $persona["Persona_apellido"]; ?>, <? echo $persona["Persona_nombre"] ?>&nbsp;</td>
    <td align="center"><? echo $personac1doc; ?> &nbsp;</td>
	<td align="center"><input name="cedula<?=$i ?>" type="text" size="1" value="<? echo $cedula; ?>"/></td>
    <td align="center"><input name="plancheta<?=$i ?>" type="text" size="1" value="<? echo $plancheta; ?>"/></td>
    <td align="center"><input name="infdom<?=$i ?>" type="text" size="1" value="<? echo $infdom; ?>"/></td>
    <td align="center"><input name="edicto<?=$i ?>" type="text" size="1" value="<? echo $edicto; ?>"/></td>
	<td align="center"><input name="camara<?=$i ?>" type="text" size="1" value="<? echo $camara; ?>"/>
	<input type="hidden" name ="cant" value="<?=$cant; ?>" />
	<input type="hidden" name="id<?=$i ?>" value="<?=$tramite["Tramite_nro"]; ?>">
	</td>
  </tr>
<?
$i++;
$num_fila++;
} 

?>
<tr><td height="60" colspan="9" align="right"><input type="submit" name="Submit" value="Asignar datos" /></td>
</tr>
</table>
</form>