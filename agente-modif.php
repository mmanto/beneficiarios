<? session_start();

include ("conec.php");
include ("funciones.php");
include("cabecera.php");


$usuario = $_SESSION["user_id"];

$idAgente = $_POST["idAgente"];

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
$comisiona = $_POST["comisiona"];
$observaciones = $_POST["observaciones"];

$sql = "UPDATE dbo_agentes SET
		agente_dni_nro = '$documento',
		agente_cuil = '$cuil',
		agente_legajo = '$legajo',
		agente_apellido = '$apellido',
		agente_nombre = '$nombre',
		agente_fechanac = '$fechanac',
		agente_domicilio = '$domicilio',
		agente_domicilio_ciudad = '$ciudad',
		agente_telefono = '$telefono',
		agente_revista_tipo = '$revista',
		agente_categoria = '$categoria',
		agente_ingreso_fecha = '$ingreso',
		agente_ecivil = '$ecivil',
		agente_comisiona = '$comisiona',
		agente_observaciones = '$observaciones'
		WHERE agente_nro = $idAgente";
		
		
if($res = mysql_query($sql)) { ?>
	
    <h2>Datos modificados correctamente</h2>
    <p>&nbsp;</p>
	
    
<? }else{ ?>

<h2>No se pudo realizar el alta de agente. Contacte al administrador</h2>
<p>&nbsp;</p>
<? } ?>
<p>Ya puede cerrar esta ventna</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>