<?

include("cabecera.php");

include ("conec.php");

$idPersona = $_GET["idPersona"];

$idFamilia = $_GET["idFamilia"];


$sql2 = mysql_query("UPDATE dbo_persona SET blnActivo = 0 WHERE Persona_nro = $idPersona");


?>
<h2>El registro ha sido eliminado correctamente</h2>
<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver al informe</a></p>