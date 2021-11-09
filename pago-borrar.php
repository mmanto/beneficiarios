<?

include("cabecera.php");

include ("conec.php");

$idPago = $_GET["idPago"];

$idTarjeta = $_GET["idTarjeta"];

$idFamilia = $_GET["idFamilia"];

$sql2 = mysql_query("UPDATE dbo_tarjeta_rendicion SET blnActivo = 0 WHERE Pago_nro = $idPago");

//$sql4 = mysql_query("UPDATE dbo_persona SET blnActivo = 0 WHERE Tramite_nro != '0' AND Tramite_nro = $idTramite");

echo "<h2>El pago se ha eliminado correctamente</h2>";
echo "<p><a href=\"tarjeta-pagos-historial.php?idTarjeta=$idTarjeta&idFamilia=$idFamilia\">Volver a la b&uacute;squeda</a>";

?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
include("pie.php");

?>