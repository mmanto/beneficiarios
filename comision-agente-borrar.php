<?
$idComAgente = $_GET["idComAgente"];

$idComision = $_GET["idComision"];

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$sql = "DELETE FROM dbo_comision_agentes WHERE Comision_agente_nro = '$idComAgente'";

if(!mysql_query($sql)) { ?>
<h2>No se pudo eliminar el registro. Contatce al administrador</h2>
<? }else{ ?>
<h2>El agente ha sido eliminado de la comisi&oacute;n</h2>
<? } ?>
<p><a href="comision-informe.php?idComision=<?=$idComision; ?>">Volver</a></p>