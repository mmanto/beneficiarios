<?

include ("conec.php");

$log_direccion = $_GET["nbsp567"];
$log_usuario = $_GET["qprst645"];
$log_nivel = $_GET["ghlst251"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

include("cabecera.php");

if(!isset($_POST["cmdAlta"])) {

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

?>
<form action="<? $_SERVER['PHP_SELF'] ?>" method="POST">
<input type="hidden" name="log_usuario" value="<?=$log_usuario ?>" />
<input type="hidden" name="log_direccion" value="<?=$log_direccion ?>" />
<input type="hidden" name="log_nivel" value="<?=$log_nivel ?>" />
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>Alta de Resoluci&oacute;n  </h2></td>
    <td width="74" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" colspan="3"><a href="javascript:history.go(-1)">Volver al panel de administraci&oacute;n </a></td>
  </tr>
  <tr>
    <td width="33" rowspan="12">&nbsp;</td>
    <td width="124" height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45"><strong>N&ordm; de resoluci&oacute;n: </strong></td>
    <td><input name="resolucion_nombre" type="text" id="resolucion_nombre" style="font-family:Tahoma; fonf-weight:bold; font-size:26pt;" size="4"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><strong>Partido:</strong></td>
    <td><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="32"><strong>Programa:</strong></td>
    <td><input name="resolucion_programa" type="text" id="resolucion_programa" size="25" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><strong>Barrio:</strong></td>
    <td><input name="resolucion_barrio" type="text" id="resolucion_barrio" /></td>
    <td>&nbsp;</td>
  <tr>
    <td height="36"><strong>Circunscripci&oacute;n:</strong></td>
    <td><input name="resolucion_circunscripcion" type="text" id="resolucion_circunscripcion" size="3" /></td>
    <td>&nbsp;</td>
  <tr>
    <td height="36"><strong>Secci&oacute;n:</strong></td>
    <td><input name="resolucion_seccion" type="text" id="resolucion_seccion" size="3" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="cmdAlta" type="submit" id="cmdAlta" value="Guardar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<? }else{ 

$resolucion_nombre = $_POST["resolucion_nombre"];
$resolucion_partido = $_POST["idPartido"];
$resolucion_circunscripcion = $_POST["resolucion_circunscripcion"];
$resolucion_seccion = $_POST["resolucion_seccion"];
$resolucion_barrio = $_POST["resolucion_barrio"];
$resolucion_programa = $_POST["resolucion_programa"];

	$sql = "INSERT INTO dbo_resolucion (
	Resolucion_nombre,
	Resolucion_partido,
	Resolucion_programa,
	Resolucion_circ,
	Resolucion_secc,
	Resolucion_barrio
	) VALUES (
	'$resolucion_nombre',
	'$resolucion_partido',
	'$resolucion_programa',
	'$resolucion_circunscripcion',
	'$resolucion_seccion',
	'$resolucion_barrio')";
	
	if (mysql_query($sql)) {
	
	
	
	
	} else {echo "Error al intentar dar de alta la Resolucion"; }
	
	?>
	<h2>La resoluci&oacute;n ha sido dada de alta con &eacute;xito!</h2>
	<p><a href="menu.php?nbsp567=<?=$log_direccion ?>&qprst645=<?=$log_usuario ?>&ghlst251=<?=$log_nivel ?>">Volver al panel de administración</a><p>
	
<? } ?>