<?

//include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$cant = $_POST["cant"];

$idUsuario = $_POST["idUsuario"];

$resUsr = mysql_query("SELECT HabExp, Area_nro FROM dbo_usuarios WHERE idUsuario = $idUsuario");
$user = mysql_fetch_array($resUsr);
$user_area = $user["Area_nro"];

$pase_origen = $_POST["origen"];

if($_POST["reingreso"] == '1') { $expte_reingreso = '1'; }else{ $expte_reingreso = '0';}


$expte_destino = $_POST["destino"];

	$sql2 = "SELECT Direccion_nro FROM dbo_area WHERE Area_nro = $expte_destino";
	$res2 = mysql_query($sql2);
	$destino = mysql_fetch_array($res2);
	$direccion_destino = $destino["Direccion_nro"];

$pase_observaciones = $_POST["pase_observaciones"];


//-------------//

//Declaración de variables

$expte_nro = $expte["Expte_nro"];

$hora = date('H:i:s');

$anio_actual = date('Y');



$sql4 = "INSERT INTO dbo_exptesmov_remitos (
		Remito_fecha,
		Remito_hora,
		Remito_area_origen,
		Remito_area_destino,
		Expte_mov_reingreso,
		Expte_mov_obs,
		idUsuario
		)VALUES(
		CURRENT_DATE,
		'$hora',
		'$pase_origen',
		'$expte_destino',
		'$expte_reingreso',
		'$pase_observaciones',
		'$idUsuario')";
		
if (!mysql_query($sql4)) { ?> 
	<? include("cabecera.php"); ?>
	<h2>Error al crear remito. Por favor contacte al administrador</h2> 

	<? }else{

$remito_nro = mysql_insert_id($link);

$sql = "SELECT * FROM dbo_exptes WHERE Expte_nro IN(".$lista.")";
$res = mysql_query($sql);

for ($i=1;$i<=$cant;$i++){ 

$expte_nro = $_POST["id".$i];

$expte_fojas = $_POST["fojas".$i];

$expte_ubicacion_area = $_POST["ubicacion".$i];

$ins = "INSERT INTO dbo_exptes_mov (
	Expte_nro,
	Expte_origen,
	Expte_destino,
	Expte_fojas,
	Expte_mov_fecha,
	Expte_mov_hora,
	Expte_mov_reingreso,
	Expte_mov_obs,
	Remito_nro,
	idUsuario
	)VALUES(
	'$expte_nro',
	'$expte_ubicacion_area',
	'$expte_destino',
	'$expte_fojas',
	CURRENT_DATE,
	'$hora',
	'$expte_reingreso',
	'$pase_observaciones',
	'$remito_nro',
	'$idUsuario')";

if (!mysql_query($ins,$link)) { ?>

	<? include("cabecera.php"); ?>
	<h2>Error al cargar el movimiento. Por favor contacte al administrador</h2>
	<?  }else{

		}
// Si el área de destino es 83 (Gestion Escrituraria) Expte_esc = 1;
		
if($expte_destino == '83') {

$upd = "UPDATE dbo_exptes SET 
		Expte_ubicacion_area = '$expte_destino',		
		Expte_ubicacion_direccion  = '$direccion_destino',
		Expte_esc = '1',
		Expte_reservado = '0',
		Expte_fojas_actual = '$expte_fojas'
		where Expte_nro = '$expte_nro'";

}else{

$upd = "UPDATE dbo_exptes SET 
		Expte_ubicacion_area = '$expte_destino',
		Expte_ubicacion_direccion  = '$direccion_destino',
		Expte_reservado = '0',
		Expte_fojas_actual = '$expte_fojas'
		where Expte_nro = '$expte_nro'";
}		

		
$ub = mysql_query($upd);

// Si el expte sale a Escribania General de Gobierno, consigna fecha en datos del expediente.

if($expte_destino == '35') {
	
$upd2 = "UPDATE dbo_exptes SET
		Expte_salida = CURRENT_DATE
		where Expte_nro = '$expte_nro'";

$ub2 = mysql_query($upd2);

}
//
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema Beneficiarios de Tierras</title>
<meta name="description" value="Sistema de Beneficiarios de Tierras" />
<meta name="author" content="Andrés J. Bilstein">
<style type="text/css">
<!--
body {
	margin-left: 50px;
	margin-top: 20px;
}
</style>

<link href="estilos.css" rel="stylesheet" type="text/css" />

<script>
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}
</script> 

<script language=JavaScript>
<!--

function inhabilitar(){
    alert ("No puede utilizar el boton derecho del mouse.\nPor favor, utilice sólo los comandos en pantalla.\nMuchas Gracias.")
    return false
}

document.oncontextmenu=inhabilitar

// -->
</script>
<script language="JavaScript">
function ventana_modif (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=860, height=760, top=70, left=80";
window.open(pagina,"",opciones);
}
</script>

<script language="JavaScript">
function ventana_imprimir (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=950, height=700, top=70, left=50";
window.open(pagina,"",opciones);
}
</script>
</head>
<body onload= "ventana_imprimir('remito-imp.php?idRemito=<?=$remito_nro; ?>')">
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/logo-ba2.jpg" alt="Buenos Aires" width="900" height="70" /></td>
  </tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td height="70" colspan="4"><h1>El pase de expedientes se realiz&oacute; correctamente</h1></td>
  </tr>
  <tr>
    <td colspan="4">Atenci&oacute;n: El pase de los epxedientes seleccionados se complet&oacute; correctamente, por lo que ya no aparecer&aacute;n en el listado de expedientes de su &aacute;rea. Usted puede seleccionar la opci&oacute;n &quot;imprimir remito&quot; para que el sistema emita un comprobante de la operaci&oacute;n, que deber&aacute; ser firmado por el receptor como prueba de conformidad de la misma. </td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="18" height="80">&nbsp;</td>
    <td width="340"><a href="#"></a> <table width="340" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="126" rowspan="2"><a href=javascript:ventana_imprimir('remito-imp.php?idRemito=<?=$remito_nro; ?>')><img src="imagen/remito-icon.png" border="0"></a></td>
        <td width="194" height="24" align="center" bgcolor="#E2E2E2"><strong>IMPRIMIR REMITO </strong></td>
      </tr>
      <tr>
        <td valign="top">Haga clic sobre la imagen para abrir el remito correspondiente al pase de expedientes. Luego de imprimirlos cierre la ventana. </td>
      </tr>
    </table></td>
    <td width="9">&nbsp;</td>
    <td width="393"><table width="370" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="130" rowspan="2"><a href="exptes-listar-area.php"><img src="imagen/menu-icon.png" width="140" height="120" border="0"></a></td>
        <td width="220" height="24" align="center" bgcolor="#E2E2E2"><strong>VOLVER AL LISTADO </strong></td>
      </tr>
      <tr>
        <td valign="top">Si omiti&oacute; la impresi&oacute;n del temite puede hacerlo posteriormente desde la opci&oacute;n &quot;Ver remitos emitidos&quot;. </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="90">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


<?
	}

include("pie.php"); ?>