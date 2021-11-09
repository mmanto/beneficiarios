<? 

include ("conec.php");
include ("funciones.php");
include("cabecera.php");


$idAgente = $_GET["idAgente"];

$sql = "UPDATE dbo_agentes SET blnActivo = '0' WHERE agente_nro = $idAgente";
		
if($res = mysql_query($sql)) { ?>
	
    <h2>El agente fue eliminado correctamente</h2>
    <p>&nbsp;</p>
    
<? }else{ ?>

<h2>No se pudo completar la acci&oacute;n. Por favor contacte al administrador</h2>
<p>&nbsp;</p>

<? } ?>
<p><a href="agentes-listar.php">Volver a la n&oacute;mina de agentes</a>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>