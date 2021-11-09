<?

include("cabecera.php");

include ("conec.php");

$idFamilia = $_GET["idFamilia"];


$docFind = $_GET["doc"];

$sql2 = mysql_query("UPDATE dbo_familia SET blnActivo = 0 WHERE Familia_nro = $idFamilia");

$sql4 = mysql_query("UPDATE dbo_persona SET blnActivo = 0 WHERE Familia_nro = $idFamilia");

echo "<h2>El registro se ha eliminado correctamente</h2>";
echo "<p><a href=\"persona_buscar_doc?docfind=$docFind\" >Volver a la b&uacute;squeda</a>";