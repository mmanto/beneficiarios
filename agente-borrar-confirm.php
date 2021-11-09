<? 

include ("funciones.php");
include("cabecera.php");

$idAgente = $_GET["idAgente"];

?>

<h2>&iquest;Realmente desea eliminar el agente seleccionado?</h2>
<p>&nbsp;</p>
<p><a href="agente-borrar.php?idAgente=<?=$idAgente; ?>">Eliminar</a> | <a href="javascript:history.back(1)">Cancelar</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


<? include("pie.php"); ?>

