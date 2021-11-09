<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idusuario = $_POST["idusuario"];
$nombre = $_POST["nombre"];
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$area = $_POST["area"];

	$sql2 = "SELECT Direccion_nro FROM dbo_area WHERE Area_nro = $area";
	$res2 = mysql_query($sql2);
	$direccion = mysql_fetch_array($res2);
	$direccion_nro = $direccion["Direccion_nro"];


$HabExp = $_POST["HabExp"];
$HabSbt = $_POST["HabSbt"];


$upd = "INSERT INTO dbo_usuarios (
		Usuario,
		Password,
		Nombre,
		Area_nro,
		Direccion_nro,
		HabExp,
		HabSbt
		)VALUES(
		'$usuario',
		'$password',
		'$nombre',
		'$area',
		'$direccion_nro',
		'$HabExp',
		'$HabSbt')";
		
if(mysql_query($upd)) {

?>
<h2>El usuario fue dado de alta correctamente</h2>
<p>&nbsp;</p>
<p><a href="usuarios-listar.php">Volver al menu</a></p>
<p>&nbsp;</p>

<? }else{ ?>

<h2>Error al actualizar los datos. Contacte al administrador</h2>
<p>&nbsp;</p>
<p><a href="usuarios-listar.phpp">Volver al menu</a></p>
<p>&nbsp;</p>


<? 
	}
} 

?>