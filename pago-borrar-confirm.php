<?

include("cabecera.php");

$idPago = $_GET["idPago"];
$idTarjeta = $_GET["idTarjeta"];
$idFamilia = $_GET["idFamilia"];

?>
<h2>&iquest;Seguro desea eliminar el pago?</h2>
<p><a href="pago-borrar.php?idPago=<?=$idPago; ?>&idTarjeta=<? echo $idTarjeta; ?>&idFamilia=<?=$idFamilia ?>">Confirmar</a> | <a href="javascript:history.back();">Cancelar</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
include("pie.php");

?>