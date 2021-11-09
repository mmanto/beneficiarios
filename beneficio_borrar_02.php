<?

include("cabecera.php");

include ("conec.php");

$idFamilia = $_GET["idFamilia"];

$sql = "SELECT * FROM dbo_familia WHERE Familia_nro = $idFamilia";
$resFlia = mysql_query($sql);
$familia = mysql_fetch_array($resFlia);





$sql2 = mysql_query("UPDATE dbo_familia SET blnActivo = 0 WHERE Familia_nro = $idFamilia");

$sql4 = mysql_query("UPDATE dbo_persona SET blnActivo = 0 WHERE Familia_nro = $idFamilia");

?>
<h2>El registro ha sido eliminado correctamente</h2>
<p>Tenga en cuenta que, para ver reflejado el cambio en el listado correspondiente, luego de cerrar esta ventana deberá refrescar la pantalla pulsando la tecla F5</p>
<p>Ya puede cerrar esta ventana</p>