<? 

include ("conec.php");
include ("funciones.php");
include("cabecera.php");


$idFamiliar = $_GET["idFamiliar"];
$idAgente = $_GET["idAgente"];

?>

<h2>&iquest;Realmente desea eliminar al miembro del grupo familiar seleccionado?</h2>
<p>Tenga en cuenta que esta acci&oacute;n no se puede deshacer.</p>
<p>&nbsp;</p>
<p><a href="agente-familiar-borrar.php?idAgente=<?=$idAgente; ?>&idFamiliar=<?=$idFamiliar; ?>">Eliminar</a> | <a href="javascript:history.back(1)">Cancelar</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


<? include("pie.php"); ?>

