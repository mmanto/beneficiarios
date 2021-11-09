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

$partido_nro = $_GET["idPartido"];

$sql3 = mysql_query("SELECT * FROM dbo_barrio WHERE Partido_nro = '$partido_nro' ORDER BY Barrio_nombre",$link);

$cant = mysql_num_rows ($sql3);


$res4 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $partido_nro");
$pdo = mysql_fetch_array($res4);
$pdoNombre = $pdo["Partido_nombre"];

?>

<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="4"><h2>Listado de barrios en proceso de regularizaci&oacute;n dominial </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="4">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="sbt-menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="16" rowspan="2">&nbsp;</td>
    <td width="542" align="right"><img src="imagen/barrio.png" width="40" height="30" /></td>
    <td width="7" align="left">&nbsp;</td>
    <td width="165" align="left"><a href="barrio_alta_form.php?idPartido=<? echo $partido_nro; ?>">Dar de alta nuevo barrio</a></td>
  </tr>
  <tr>
    <td colspan="3" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="3"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="45" height="25" align="center" class="titulo_dato">Id.</td>
        <td width="254" align="center" class="titulo_dato">Partido</td>
        <td width="277" align="center" class="titulo_dato">Barrio</td>
        <td colspan="10" align="center" class="titulo_dato">Acciones</td>
        </tr>
<?

while ($barrio = mysql_fetch_array($sql3)) {	

?>
      <tr>
        <td height="30" align="center" ><?=$barrio["Barrio_nro"] ;?></td>
        <td align="center"><?=$pdoNombre; ?>&nbsp;</td>
        <td align="center"><?=$barrio["Barrio_nombre"] ;?></td>
        <td width="30" align="center" ><a href="beneficio_porbarrio_listar.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>&criterio=0&expte=0&origen=<? echo array_pop(explode('/', $_SERVER['PHP_SELF'])); ?>"><img src="imagen/benef.jpg" border="0" title="Listar beneficios del barrio" Alt="Listar beneficios del barrio"/></a></td>
        <td width="34" align="center" ><? if($user["p702"]== '1') { ?><a href="beneficio_alta_porbarrio_form.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>"><? } ?><img src="imagen/benef-add.jpg" border="0" title="Agregar nuevo beneficio al barrio" Alt="Agregar nuevo beneficio al barrio"/></a></td>
        <td width="41" align="center" ><? if($user["p702"]== '1') { ?><a href="beneficio_alta_porbarrio_multiple_form.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>"><? } ?><img src="imagen/benef-add-multiple.jpg" border="0" title="Agregar nuevo beneficio al barrio (multiple)" Alt="Agregar nuevo beneficio al barrio (multiple)"/></a></td>
        <td width="30" align="center"><img src="imagen/superficie.png" width="18" height="18" title="Asignar superficies" Alt="Asignar superficies"/></td>
        <td width="23" align="center">
        <a href="<? if($user["p763"]== '1') { ?>valores-asigna-form.php?idBarrio=<?=$barrio["Barrio_nro"]; ?><? }else{ echo "#"; } ?>"><img src="imagen/valores.png" width="19" height="19" title="Asignar valores (manualmente)"/>
        </a></td>
        <td width="20" align="center"><a href="<? if($user["p763"]!='1') { echo "#"; }else{ ?>valores-computar-form.php?idBarrio=<?=$barrio["Barrio_nro"]; } ?>"><img src="imagen/calc.png" width="19" height="19" title="Computar valores (aut.)" Alt="Computar valores (aut.)"/></a></td>
        <td width="21" align="center"><a href="beneficio_porbarrio_listar_control.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>""><img src="imagen/list.png" width="16" height="12" title="Listado control"/></a></td>
        <td width="27" align="center"><a href="beneficio_porbarrio_listar_control_xls.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>""><img src="imagen/excel.png" width="19" height="19" title="Generar listado control (Excel)" Alt="Generar listado control (Excel)"/></a></td>
        <td width="21" align="center" ><a href="beneficio_porbarrio_listar_boleto.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>&criterio=4"><img src="imagen/boleto.jpg" width="15" height="19" title="Generar Boletos de compra-venta"/></a></td>
        <td width="30" align="center" ><? if ($user["HabSbt"] <= 6 ) { ?><a href="barrio_modif_form.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>"><? } ?><img src="imagen/edit.png" width="16" height="16" border="0" title="Modificar datos barrio"/></a></td>
      </tr>
		
	  <? } ?>
    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<?  
include "pie.php";
?>
<? } ?>