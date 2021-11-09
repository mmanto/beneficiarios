<? 

include ("conec.php");
include ("funciones.php");
include("cabecera.php");


$idFamiliar = $_GET["idFamiliar"];
$idAgente = $_GET["idAgente"];

$sql = "DELETE FROM dbo_agente_familia WHERE familiar_nro = $idFamiliar";
		
if($res = mysql_query($sql)) { ?>
	
    <h2>El integrante de grupo familiar fue eliminado correctamente</h2>
    <p>&nbsp;</p>
    
<? }else{ ?>

<h2>No se pudo completar la acci&oacute;n. Por favor contacte al administrador</h2>
<p>&nbsp;</p>

<? } ?>
<p><a href="agente-familia-listar.php?idAgente=<?=$idAgente; ?>">Volver al listado de familiares</a>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>