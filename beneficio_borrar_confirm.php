<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$idFamilia = $_GET["idFamilia"];
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
		<h2>¿Realmente desea eliminar esta informaci&oacute;n</h2>
		<p>Tenga en cuenta que, una vez que haya eliminado la informaci&oacute;n del beneficio, no podr&aacute; ser recuperada.</p> 
		<p><a href="beneficio_borrar.php?idFamilia=<?=$idFamilia; ?>&doc=<?=$_GET["doc"]; ?>">Borrar</a> | <a href="javascript:history.go(-1)">Cancelar</a></p>

<? } ?>



