<? 

include ("conec.php");
include ("funciones.php");
include("cabecera.php");


$usuario = $_SESSION["user_id"];

$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$fechanac = $_POST["fechanac"];
$observaciones = $_POST["observaciones"];
$vinculo = $_POST["vinculo"];
$idAgente = $_POST["idAgente"];

$sql = "INSERT INTO dbo_agente_familia (
		familiar_apellido,
		familiar_nombre,
		familiar_dni_nro,
		familiar_fechanac,
		familiar_vinculo,
		familiar_observaciones,
		agente_nro
		)VALUES(
		'$apellido',
		'$nombre',
		'$documento',
		'$fechanac',
		'$vinculo',
		'$observaciones',
		'$idAgente')";
		
if($res = mysql_query($sql)) { ?>
	
    <h2>Familiar dado de alta correctamente</h2>
    <p>&nbsp;</p>
    
<? }else{ ?>

<h2>No se pudo realizar el alta de familiar. Contacte al administrador</h2>
<p>&nbsp;</p>
<p><?=$apellido; ?></p>
<p><?=$nombre; ?></p>
<p><?=$documento; ?></p>
<p><?=$fechanac; ?></p>
<p><?=$observaciones; ?></p>
<p><?=$vinculo; ?></p>
<p><?=$idAgente; ?></p>
<? } ?>
<p><a href="agente-familia-listar.php?idAgente=<?=$idAgente; ?>">Volver al listado de familiares</a>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>