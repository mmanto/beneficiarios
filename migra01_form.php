<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$sql789 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) ORDER BY Partido_nombre ASC",$link);


$origen = $_GET["origen"];
?>
<form action="migra01.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="origen" value="<?=$origen; ?>" />
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>Migrar desde archivo </h2></td>
    <td width="31" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" colspan="3"><a href="menu.php">Volver al menu </a></td>
  </tr>
  <tr>
    <td width="32" rowspan="8">&nbsp;</td>
    <td width="187" height="35">&nbsp;</td>
    <td width="350">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35" valign="middle"><strong>Nombre del Barrio:</strong></td>
    <td valign="middle"><select name="barrio_nro" id="barrio_nro">
  <option value="0">Seleccione un barrio</option>
  <?	  while ($barrio = mysql_fetch_array($sql789)) {	

$barrio_nro = $barrio["Barrio_nro"];
$barrio_partido = $barrio["Partido_nombre"];
$barrio_nombre = $barrio["Barrio_nombre"];
?>
  <option value="<? echo $barrio_nro; ?>"
<? if($barrio_nro == $familia_barrio) { ?>selected="selected"<? } ?>><?=$barrio_partido; ?> - <?=$barrio_nombre; ?></option>
  <? } ?>
</select>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35" valign="middle"><strong>Origen del beneficio:</strong></td>
    <td valign="middle"><select name="beneficio_origen" id="beneficio_origen">
		<option value="0">Seleccione una dirección</option>
		<option value="1">Dirección de Reg. Urbana y Dominial</option>
		<option value="2">Dirección del Plan Familia Propietaria</option>
		<option value="7">Dirección de Gestión Escrituraria</option>
      </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35" valign="middle"><strong>Nombre del Archivo:</strong></td>
    <td valign="middle"><input name="archivo_nombre" type="text" id="archivo_nombre" size="26" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="35" valign="middle"><strong>Identificador migraci&oacute;n: </strong></td>
    <td valign="middle"><input name="idMigracion" type="text" id="idMigracion" size="26" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Migrar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="65">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
<? } ?>
