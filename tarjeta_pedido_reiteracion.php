<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idTarjeta = $_GET["idTarjeta"];
$familianum = $_GET["idFamilia"];

$nmbArchivo = "ALT".date("Y").date("m").date("d").".txt";


$sql = "SELECT * from dbo_tarjeta WHERE Tarjeta_nro = $idTarjeta";
$res = mysql_query($sql);
$tarjeta = mysql_fetch_array($res);

$numtarjeta = $tarjeta["Tarjeta_numero"];
$titular_apellido = $tarjeta["Tarjeta_titular_apellido"];
$titular_nombre = $tarjeta["Tarjeta_titular_nombre"];

$file = fopen($nmbArchivo, "a+");

fwrite($file, $numtarjeta.$titular_apellido."                               ".$titular_nombre."\r\n");

fclose($file);

echo "<h2>La tarjeta ha sido agregada al pedido de tarjetas del día de la fecha</h2>";
echo "<p><a href=\"beneficio_informe.php?idFamilia=".$familianum."\">Volver</a>";



//echo "<p>".$numtarjeta." - ".$titular_apellido.", ".$titular_nombre."<p>";


?>
</body>
</html>