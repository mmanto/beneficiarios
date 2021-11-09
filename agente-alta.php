<? session_start();
$usuario = $_SESSION["user_id"];

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$ingreso = cambiaf_a_mysql($_POST["fechaingreso"]);
$legajo = $_POST["legajo"];
$revista = $_POST["revista"];
$categoria = $_POST["categoria"];
$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$cuil = $_POST["cuil"];
$ecivil = $_POST["ecivil"];
$fechanac = cambiaf_a_mysql($_POST["fechanac"]);
$domicilio = $_POST["domicilio"];
$ciudad = $_POST["ciudad"];
$telefono = $_POST["telefono"];
$observaciones = $_POST["observaciones"];

$sql = "INSERT INTO dbo_agentes (
		agente_dni_nro,
		agente_cuil,
		agente_legajo,
		agente_apellido,
		agente_nombre,
		agente_domicilio,
		agente_domicilio_ciudad,
		agente_telefono,
		agente_fechanac,
		agente_revista_tipo,
		agente_categoria,
		agente_ingreso_fecha,
		agente_ecivil,
		agente_observaciones,
		agente_alta_fecha,
		agente_alta_usuario,
		blnActivo
		)VALUES(
		'$documento',
		'$cuil',
		'$legajo',
		'$apellido',
		'$nombre',
		'$domicilio',
		'$ciudad',
		'$telefono',
		'$fechanac',
		'$revista',
		'$categoria',
		'$ingreso',
		'$ecivil',
		'$observaciones',
		CURRENT_DATE,
		'$usuario',
		'1')";
if($res = mysql_query($sql)) { ?>
	
    <h2>Agente dado de alta correctamente</h2>
    <p>&nbsp;</p>
	<p><a href="agente-alta-form.php">Dar de alta otro agente</a>
    
<? }else{ ?>

<h2>No se pudo realizar el alta de agente. Contacte al administrador</h2>
<p>Fecha ingreso: <?=$ingreso; ?></p>
<p>Sit. revista: <?=$revista; ?></p>
<p>Apellido: <?=$apellido; ?></p>
<p>Nombre: <?=$nombre; ?></p>
<p>Documento: <?=$documento; ?></p>
<p>Domicilio: <?=$domicilio; ?></p>
<p>Ciudad: <?=$ciudad; ?></p>
<p>Telefono: <?=$telefono; ?></p>
<p>Obs: <?=$observaciones; ?></p>
<p>&nbsp;</p>
<? } ?>

<p><a href="agentes-listar.php">Volver al menu</a>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>