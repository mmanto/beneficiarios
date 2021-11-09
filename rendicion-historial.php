<?
include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$sql = "SELECT DISTINCT Archivo FROM dbo_tarjeta_rendicion ORDER BY Archivo";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

?>
<h2>Archivos de rendici&oacute;n procesados</h2>
<p><a href="sbt-menu.php">Volver</a></p>
<p>&nbsp;</p>
<p>A la fecha se han procesado un total de <?=$cant; ?> archivos:</p>
<table width="350" border="0" cellpadding="0" cellspacing="0">
<tr><td height="36">&nbsp;</td><td align="center"><strong>Archivo</strong></td>
<td align="center"><strong>Fecha rendici&oacute;n</strong></td></tr>
<?
while ($rendicion = mysql_fetch_array($res)) { 

$archivo = $rendicion["Archivo"];

$fecha_dia = substr($archivo, 14, 2);
$fecha_mes = substr($archivo, 12, 2);
$fecha_anio = substr($archivo, 8, 4);

?>
	<tr>
    	<td width="21" height="20">&nbsp;</td><td width="167" align="center"><? echo $archivo; ?></td>
    	<td width="162" align="center"><? echo $fecha_dia." - ".$fecha_mes." - ".$fecha_anio; ?></td>	
    </tr>
<? } ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? include ("pie.php");
