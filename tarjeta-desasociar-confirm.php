<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$idTarjeta = $_GET["idTarjeta"];
$idFamilia = $_GET["idFamilia"];

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
		<h2>&iquest;Realmente desea desasociar esta tarjeta? (<?=$idTarjeta; ?>)</h2>
		<p><a href="tarjeta-desasociar.php?idTarjeta=<?=$idTarjeta; ?>&idFamilia=<?=$idFamilia; ?>">Desasociar</a> | <a href="javascript:history.go(-1)">Cancelar</a></p> 
		<? } ?>



