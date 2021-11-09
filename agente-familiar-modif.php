<? 

include ("conec.php");
include ("funciones.php");
include("cabecera.php");


$idFamiliar = $_POST["idFamiliar"];

$idAgente = $_POST["idAgente"];

$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$fechanac = $_POST["fechanac"];
$vinculo = $_POST["vinculo"];
$observaciones = $_POST["observaciones"];

$sql = "UPDATE dbo_agente_familia SET
		familiar_apellido = '$apellido',
		familiar_nombre = '$nombre',
		familiar_fechanac = '$fechanac',
		familiar_vinculo = '$vinculo',
		familiar_dni_nro = '$documento',
		familiar_observaciones = '$observaciones'
		WHERE familiar_nro = $idFamiliar";
		
		
if($res = mysql_query($sql)) { ?>
	
    <h2>Datos actualizados correctamente</h2>
    <p>&nbsp;</p>    
<? }else{ ?>

<h2>No se pudo realizar la actualizaci&oacute;n. Contacte al administrador</h2>
<p>&nbsp;</p>
<? } ?>
<p><a href="agente-familia-listar.php?idAgente=<?=$idAgente ?>">Volver</a>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>