<?

include("cabecera.php");

$idTramite = $_GET["idTramite"];
$apellido = $_GET["apellido"];

?>
<h2>&iquest;Seguro desea borrar el registro seleccionado?</h2>
<p><a href="tramiteley_borrar.php?idTramite=<?=$idTramite; ?>&apellido=<? echo $apellido; ?>">Confirmar</a> | <a href="javascript:history.back();">Cancelar</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
include("pie.php");

?>