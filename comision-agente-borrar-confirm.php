<?
$idComAgente = $_GET["idComAgente"];

$idComision = $_GET["idComision"];

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

?>
<h2>&iquest;Confirma eliminaci&oacute;n del agente de esta comisi&oacute;n?</h2>
<p>&nbsp;</p> 
<p><a href="comision-agente-borrar.php?idComAgente=<?=$idComAgente; ?>&idComision=<?=$idComision;?> ">Confirmar</a> - <a href="comision-informe.php?idComision=<?=$idComision; ?>">Cancelar</a></p>
