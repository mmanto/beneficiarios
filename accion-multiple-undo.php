<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$pag_origen = $_POST["pag_origen"];

$barrio_origen = $_POST["barrio_origen"];

$lista = implode(',',$_POST['seleccion']); 

$accion = $_POST["accion"];

$expte = $_POST["expte_esc_nro"];

$barrio_nro = $_POST["barrio_nro"];

//Compruebo que accion no esté vacío

if (!$_POST["accion"]) {

?>
<h2>No ha indicado ninguna acci&oacute;n para los beneficios seleccionados</h2>
<p>Por favor, seleccione una acci&oacute;n</p>
<p><a href="<? echo $pag_origen."?idBarrio=".$barrio_origen;?>">Volver</a></p>

<? }else{ 

if (!$_POST["seleccion"]) { ?>

<h2>No ha seleccionado ningun beneficio</h2>
<p>Debe seleccionar al menos un beneficio para aplicar la acci&oacute;n indicada</p>
<p><a href="<? echo $pag_origen."?idBarrio=".$barrio_origen;?>">Volver</a></p>

<? }else{ 

if ($accion == '1') {

$sql = "UPDATE dbo_familia SET Expte_esc_nro = '$expte' WHERE Familia_nro IN(".$lista.")";

}elseif ($accion == '2') {

$sql = "UPDATE dbo_familia SET Barrio_nro = '$barrio_nro' WHERE Familia_nro IN(".$lista.")";

}elseif ($accion == '3') {

$sql = "UPDATE dbo_familia SET Familia_doc_completa = '1' WHERE Familia_nro IN(".$lista.")";

}elseif ($accion == '4') {

$sql = "UPDATE dbo_familia SET Familia_doc_completa = '0' WHERE Familia_nro IN(".$lista.")";

}elseif ($accion == '5') {

$sql = "UPDATE dbo_familia SET Familia_pagocancelado = '1' WHERE Familia_nro IN(".$lista.")";

}elseif ($accion == '6') {

$sql = "UPDATE dbo_familia SET Familia_pagocancelado = '0' WHERE Familia_nro IN(".$lista.")";

}elseif ($accion == '7') {

$sql = "UPDATE dbo_familia SET Familia_cond_escrit = '1' WHERE Familia_nro IN(".$lista.")";

}else{

$sql = "UPDATE dbo_familia SET Familia_cond_escrit = '0' WHERE Familia_nro IN(".$lista.")";

}

?>
<? if (mysql_query($sql)) { ?>

<h2>Registros actualizados correctamente</h2>

<? }else{ ?>

<h2>Los registros no pudieron ser actualizados</h2>

<? } ?>
<p><a href="<? echo $pag_origen."?idBarrio=".$barrio_origen;?>">Volver al listado</a></p>

<? }  } ?>