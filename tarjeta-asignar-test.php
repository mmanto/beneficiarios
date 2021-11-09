<? session_start();

/////////////////////////////////
$tabla_tarjeta = "dbo_tarjeta";
/////////////////////////////////

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idUsuario = $_SESSION["user_id"];
$familia_nro = $_POST["idFamilia"];
$tarjeta = $_POST["tarjeta"];
$titular_apellido = $_POST["titular_apellido"];
$titular_nombre = $_POST["titular_nombre"];


echo "<p>".$idUsuario."</p>";
echo "<p>".$familia_nro."</p>";
echo "<p>".$tarjeta."</p>";
echo "<p>".$titular_apellido."</p>";
echo "<p>".$titular_nombre."</p>"; 
?>
<p>&nbsp;</p>
<p><a href="beneficio_informe.php?idFamilia=<? echo $familia_nro; ?>">Volver</a></p>