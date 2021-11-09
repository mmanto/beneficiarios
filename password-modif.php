<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idusuario = $_POST["idusuario"];
$password = $_POST["password"];

$upd = "UPDATE dbo_usuarios SET
		Password = '$password'
		WHERE idUsuario = '$idusuario'";
		
if(mysql_query($upd)) {

?>
<h2>Los datos fueron actualizados correctamente</h2>
<p>&nbsp;</p>
<p>Ya puede cerrar esta ventana</p>
<p>&nbsp;</p>

<? }else{ ?>

<h2>Error al actualizar los datos. Contacte al administrador</h2>
<p>&nbsp;</p>
<p>Ya puede cerrar esta ventana</p>
<p>&nbsp;</p>


<? 
	}
} 

?>

