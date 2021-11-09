<? 

include ("funciones.php");
include("cabecera.php");

$idAgente = $_GET["idAgente"];
$idLicencia = $_GET["idLicencia"];

?>

<h2>&iquest;Realmente desea eliminar la licencia seleccionada?</h2>
<p>&nbsp;</p>
<p><a href="licencia-borrar.php?idLicencia=<?=$idLicencia; ?>&idAgente=<?=$idAgente; ?>">Eliminar</a> | <a href="javascript:history.back(1)">Cancelar</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


<? include("pie.php"); ?>

