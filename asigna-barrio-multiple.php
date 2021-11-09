<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");




$idPartido = $_POST["idPartido"];

$accion = $_POST["accion"];


$lista = implode(',',$_POST['seleccion']); 


//Compruebo que accion no esté vacío

if (!$_POST["seleccion"]) { ?>

<h2>No ha seleccionado ningun beneficio</h2>
<p>Debe seleccionar al menos un beneficio para aplicar la acci&oacute;n indicada</p>
<p><a href="<? echo "beneficio_sinbarrio_listar.php?idPartido =".$idPartido; ?>">Volver</a></p>

<? }else{ 

$barrio_nro = $_POST["barrio_nro"];
	$partidoSegunBarrio1 = mysql_query("SELECT * FROM dbo_barrio WHERE Barrio_nro = $barrio_nro");
	$partidoSegunBarrio = mysql_fetch_array($partidoSegunBarrio1);
	$pdoBarrio =  $partidoSegunBarrio["Partido_nro"];

$sql = "UPDATE dbo_familia SET Barrio_nro = '$barrio_nro', Partido_nro = '$pdoBarrio' WHERE Familia_nro IN(".$lista.")";

if (mysql_query($sql)) { ?>

<h2>Actualizaci&oacute;n correcta</h2>
<p><a href="beneficio_sinbarrio_listar.php?idPartido=<?=$idPartido; ?>">Volver</a>

<? }else{ ?>

<h2>No se pudo realizar la acci&oacute;n</h2>
<p><a href="beneficio_sinbarrio_listar.php?idPartido=<?=$idPartido; ?>">Volver</a>

<? }} ?>

