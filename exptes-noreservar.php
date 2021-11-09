<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

//$idUsuario = $_POST["idUsuario"];
//$exptePadre = $_POST["exptePadre"];


$lista = implode(',',$_POST['seleccion']); 

//Comprueba si hay expedientes seleccionados

$seleccion = $_POST['seleccion'];

$cant = count($_POST['seleccion']);


if ($cant < 1) { ?>

	<h1>Debe seleccionar al menos un expediente para realizar la operaci&oacute;n</h1>
	<p>&nbsp;</p>
	<p><a href="javascript:window.history.back();">Volver</a></p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
<? }else{ 
 
$sql = "UPDATE dbo_exptes SET
		Expte_reservado = '0'
		WHERE Expte_nro IN(".$lista.")";
if($res = mysql_query($sql)) {
	
?>
<h2>Los expedientes han sido devueltos al listado general del &aacute;rea</h2>
<p><a href="exptes-reservados-area.php">Volver</p>
<p>&nbsp;</p>

<? }else{ ?>

<h2>No se puedo completar la operación. Contacte al administrador</h2>
<p><a href="exptes-reservados-area.php">Volver</p>
<p>&nbsp;</p> 

<? } } ?>