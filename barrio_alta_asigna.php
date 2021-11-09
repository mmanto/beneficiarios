<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idPartido = $_POST["idPartido"];

$barrio_nombre = $_POST["barrio_nombre"];

$idPartido = $_POST["idPartido"];

$lista = implode(',',$_POST["seleccion"]); 

$ins = "INSERT INTO dbo_barrio (
	Partido_nro,
	Barrio_nombre
	) VALUES (
	'$idPartido',
	'$barrio_nombre')";
	
	if (mysql_query($ins)) { 
	$barrio_nro = mysql_insert_id();
	
$ins2 = "UPDATE dbo_familia SET Barrio_nro = '$barrio_nro' WHERE Familia_nro IN(".$lista.")";

if (!mysql_query($ins2)) {

echo "No se pudo realizar la accion";

}else{


?>

<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>Dar de alta  nuevo barrio </h2></td>
    <td width="31" rowspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="26" colspan="3">El barrio fue dado de alta correctamente. (<?=$barrio_nro; ?>)</td>
  </tr>
  <tr>
    <td height="16" colspan="3"><? echo "<a href=\"beneficio_sinbarrio_listar.php?idPartido=".$idPartido."\">Volver al listado"; ?></td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td width="187">&nbsp;</td>
    <td width="350">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? }} ?>
<?       
include "pie.php";
?>

