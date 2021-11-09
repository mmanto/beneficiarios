<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$idFamilia = $_GET["idFamilia"];
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
		<h2>¿Realmente desea eliminar este beneficio? </h2>
		<p><a href="beneficio_borrar_02.php?idFamilia=<?=$idFamilia; ?>">Borrar</a> | <a href="javascript:history.go(-1)">Cancelar</a></p> 
		<? } ?>



