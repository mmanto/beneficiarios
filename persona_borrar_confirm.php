<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$idPersona = $_GET["idPersona"];
$idFamilia = $_GET["idFamilia"];

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
		<h2>&iquest;Realmente desea eliminar esta persona? Esta acci&oacute;n no se puede deshacer</h2>
		<p><a href="persona_borrar.php?idPersona=<?=$idPersona; ?>&idFamilia=<?=$idFamilia; ?>">Borrar</a> | <a href="javascript:history.go(-1)">Cancelar</a></p> 
		<? } ?>



