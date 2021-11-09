<?

include("cabecera.php");

include ("conec.php");

$idTarjeta = $_GET["idTarjeta"];
$idFamilia = $_GET["idFamilia"];



$sql2 = mysql_query(
"UPDATE
dbo_tarjeta SET
Familia_nro = '0',
Tarjeta_titular_apellido = 'S/D',
Tarjeta_titular_nombre = 'S/D'
WHERE Tarjeta_nro = $idTarjeta");



?>
<h2>La tarjeta fue desasociada del beneficio</h2>
<p>&nbsp;</p>
<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">[Volver]</a></p>