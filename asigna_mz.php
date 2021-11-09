<?

include("cabecera.php");
include ("conec.php");

$barrio_nro = $_POST["Barrio_nro"];
$mz_def = $_POST["Mz_def"];
$mz_prov = $_POST["Mz_prov"];

//Atencion_ está configurado para poner la provisoria segun la definitiva

$sql = "UPDATE dbo_familia SET Lote_manzana_prov = '$mz_prov' WHERE Lote_manzana = '$mz_def' AND Barrio_nro = '$barrio_nro'";

if(mysql_query($sql)) {

echo "<h2>Procesado correctamente.</h2><p><a href=\"asigna_mz_form.php\">Actualizar otra manzana</a></p><p><a href=\"menu.php\">Volver al menu</a></p>";

}else{

echo "<h2>Error: no se pudo actualizar</h2><p><a href=\"asigna_mz_form.php\">Actualizar otra manzana</a></p><p><a href=\"menu.php\">Volver al menu</a></p>"; }

?>
