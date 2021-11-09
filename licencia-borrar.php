<? 

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$idAgente = $_GET["idAgente"];
$idLicencia = $_GET["idLicencia"];

$sql = "UPDATE dbo_agente_licencia SET blnActivo = '0' WHERE licencia_nro = $idLicencia";
		
if($res = mysql_query($sql)) { ?>
	
    <h2>La licencia fue eliminada correctamente</h2>
    <p>&nbsp;</p>
    
<? }else{ ?>

<h2>No se pudo completar la acci&oacute;n. Por favor contacte al administrador</h2>
<p>&nbsp;</p>

<? } ?>
<p><a href="agente-licencias.php?idAgente=<?=$idAgente; ?>">Volver a la gesti&oacute;n de licencias</a>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>