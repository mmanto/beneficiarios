<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idUsuario = $_POST["idUsuario"];
$exptePadre = $_POST["exptePadre"];

echo "AAA Expte: ".$exptePadre."</br>";

$lista = implode(',',$_POST['seleccion']); 

//Comprueba si hay expedientes seleccionados

$seleccion = $_POST['seleccion'];

$cant = count($_POST['seleccion']);


if ($cant < 1) { ?>

	<h1>Debe seleccionar al menos un expediente para agregar</h1>
	<p>&nbsp;</p>
	<p><a href="javascript:window.history.back();">Volver al listado de expedientes</a></p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
<? }else{ 
 
$sql = "UPDATE dbo_exptes SET
		Expte_padre = '$exptePadre'
		WHERE Expte_nro IN(".$lista.")";
if($res = mysql_query($sql)) {
	
?>
<h2>Los expedientes han sido agregados</h2>
<p><a href="exptes-listar-area.php?ordenar=1">Volver</p>
<p>&nbsp;</p>

<? }else{ ?>

<h2>No se puedo agregar el expediente. Contacte al administrador</h2>
<p><a href="exptes-listar-area.php?ordenar=1">Volver</p>
<p>&nbsp;</p> 

<? } } ?>
