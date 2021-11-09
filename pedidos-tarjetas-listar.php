<?
include ("cabecera.php");
include ("conec.php");
?>
<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><h2>Pedidos de tarjetas generados</h2></td>
  </tr>
  <tr>
    <td colspan="2"><a href="menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td width="50">&nbsp;</td>
    <td width="600">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
</tr>
<?

$ruta = "./";
 
$filehandle = opendir($ruta);
 
while ($file = readdir($filehandle)) { ?>


<?
	if ($file != "." && $file != ".." && substr($file,-4)==".txt" && substr($file,0,3)=="ALT") {
	
	$cadena3 = substr($file,3,4);
	$cadena2 = substr($file,7,2);
	$cadena1 = substr($file,9,2);
	
	
	
 
		echo "<tr height=\"22\"><td>&nbsp;</td><td>Archivo: <strong>".$file."</strong> | Fecha de creaci&oacute;n: <strong>".$cadena1."/".$cadena2."/".$cadena3."</strong> <a href=\"descargar.php?f=".$file."\">[Descargar archivo]</a></td><tr>";
	}

}  
closedir($filehandle);

?>
</ul>

