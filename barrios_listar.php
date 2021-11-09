<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

include ("funciones.php");

include("cabecera.php");


mysql_select_db("MyTierras",$link);

/////////////////////////////////////////////////////



/*
  
if (!$resolucion_busqueda) {echo "<h2>Por favor, ingrese un n&uacute;mero de resoluci&oacute;n</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{

$sql = "SELECT Familia_nro, Lote_nro FROM dbo_familia where Familia_resolucion = '$resolucion_busqueda'";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

if ($cant < 1) {echo "<h2>No hay resultados que coincidan con su b&uacute;squeda</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{
*/



$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) ORDER BY Partido_nombre ASC",$link);


$cant = mysql_num_rows ($sql3);



$cant = mysql_num_rows ($sql3);


?>

<table width="730" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="3"><h2>Listado de barrios en proceso de regularizaci&oacute;n dominial </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="3">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="3" valign="bottom"><a href="sbt-menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="16" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="13" rowspan="2">&nbsp;</td>
    <td width="281" align="left"><a href="barrio_alta_form.php?origen=<?=basename($_SERVER['PHP_SELF']); ?>">[Dar de alta nuevo barrio]  </a></td>
    <td width="282" align="left">Cant: <?=$cant; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="2"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="43" height="25" align="center" class="titulo_dato">Id.</td>
        <td width="235" align="center" class="titulo_dato">Partido</td>
        <td width="334" align="center" class="titulo_dato">Barrio</td>
        <td colspan="3" align="center" class="titulo_dato">Acciones</td>
        </tr>
<?

while ($barrio = mysql_fetch_array($sql3)) {	

?>
      <tr>
        <td height="30" align="center" ><?=$barrio["Barrio_nro"] ;?></td>
        <td align="center"><?=$barrio["Partido_nombre"] ;?></td>
        <td align="center"><?=$barrio["Barrio_nombre"] ;?></td>
        <td width="31" align="center" ><a href="beneficio_porbarrio_listar.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>&criterio=0&expte=0&origen=<? echo array_pop(explode('/', $_SERVER['PHP_SELF'])); ?>"><img src="imagen/benef.jpg" border="0" /></a></td>
        <td width="28" align="center" ><? if($user["HabSbt"] <= 6) { ?><a href="beneficio_alta_porbarrio_form.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>"><? } ?><img src="imagen/benef-add.jpg" border="0" /></a></td>
        <td width="29" align="center" ><? if ($user["HabSbt"] <= 5 ) { ?><a href="barrio_modif_form.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>"><? } ?><img src="imagen/edit.png" width="16" height="16" border="0" title="Modificar datos barrio"/></a></td>
      </tr>
		
	  <? } ?>
	  <tr>
	  	<td>&nbsp;</td>
		<td align="center">Sin partido</td>
		<td align="center">Sin barrio</td>
		<td align="center"><a href="beneficio_porbarrio_listar2.php?idBarrio=0&criterio=0"><img src="imagen/benef.jpg" border="0" /></a></td>
		<td colspan="2">&nbsp;</td>
	  </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?  
include "pie.php";
?>
<? } ?>