<?

include("cabecera.php");

include ("conec.php");

$idPersona = $_GET["idPersona"];
$idFamilia = $_GET["idFamilia"];
/*
$sql = "SELECT * FROM dbo_persona WHERE Persona_nro = $idPersona";
$resFlia = mysql_query($sql);
$familia = mysql_fetch_array($resFlia);
*/


$sql2 = mysql_query("UPDATE dbo_persona SET blnActivo = 0 WHERE Persona_nro = $idPersona");

//$sql4 = mysql_query("UPDATE dbo_persona SET blnActivo = 0 WHERE Familia_nro = $idFamilia");

?>
<h2>El registro ha sido eliminado correctamente</h2>
<p>Tenga en cuenta que, para ver reflejado el cambio en el listado correspondiente, luego de cerrar esta ventana deberá refrescar la pantalla pulsando la tecla F5</p>
<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">[Volver]</a></p>