<?
include ("cabecera.php");
include ("conec.php");

$origen = $_POST["origen"];

$expte_esc_nro = $_POST["expte_esc"];

$Familia_nro = $_POST["idFamilia"];

$sql = mysql_query("UPDATE dbo_familia SET Expte_esc_nro = '$expte_esc_nro' WHERE Familia_nro = $Familia_nro");


?>

<h1>Registrado actualizado correctamente</h1>
<p><a href="<?=$origen; ?>?idFamilia=<?=$Familia_nro; ?>">Volver al informe</a></p>