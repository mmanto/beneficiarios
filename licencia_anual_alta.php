<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idAgente = $_POST["idAgente"];
$anio = $_POST["anio"];
$dias = $_POST["dias"];

$sql = "INSERT into dbo_agente_licencia_anual (
		licencia_anual_anio,
		licencia_anual_total,
		licencia_anual_restante,
		agente_nro
		)VALUES(
		'$anio',
		'$dias',
		'$dias',
		'$idAgente')";
		
if(mysql_query($sql)) { ?>
	
<h2>Inserci&oacute;n realizada</h2>
<p><a href="agente-licencias.php?idAgente=<? echo $idAgente; ?>">Volver</a></p>	
	
    
<? }else{ echo "<h2>No se pudo realizar la inserci&oacute;n</h2>"; }

include ("pie.php");

?>