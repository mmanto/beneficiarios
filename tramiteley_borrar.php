<?

include("cabecera.php");

include ("conec.php");

$idTramite = $_GET["idTramite"];


$apellido = $_GET["apellido"];

$sql2 = mysql_query("UPDATE dbo_tramite_ley SET blnActivo = 0 WHERE Tramite_nro = $idTramite");

$sql4 = mysql_query("UPDATE dbo_persona SET blnActivo = 0 WHERE Tramite_nro != '0' AND Tramite_nro = $idTramite");

echo "<h2>El registro se ha eliminado correctamente</h2>";
echo "<p><a href=\"tramite_buscar_nmb.php?apellfind=$apellido\" >Volver a la b&uacute;squeda</a>";

?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
include("pie.php");

?>