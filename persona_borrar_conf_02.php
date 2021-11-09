<? 

$idFamilia = $_GET["idFamilia"];
$idPersona = $_GET["idPersona"];
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
		<h2>¿Realmente desea eliminar este beneficiario? </h2>
		<p><a href="persona_borrar_02.php?idPersona=<?=$idPersona; ?>&idFamilia=<?=$idFamilia; ?>">Borrar</a> | <a href="javascript:history.go(-1)">Cancelar</a></p> 



