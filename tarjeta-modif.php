<? session_start();

////////////////////////////////////
$tabla_tarjeta = "dbo_tarjeta";
////////////////////////////////////

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idTarjeta = $_POST["idTarjeta"];
$idFamilia = $_POST["idFamilia"];
$idUsuario = $_SESSION["user_id"];
$tarjeta_monto_cuotas = $_POST["Tarjeta_monto_cuotas"];
$tarjeta_monto_intereses = $_POST["Tarjeta_monto_intereses"];

//$tarjeta_cancelacion_monto = $_POST["Tarjeta_cancelacion_monto"];
//$tarjeta_cancelacion_fecha = $_POST["Tarjeta_cancelacion_fecha"];

$sql = "UPDATE $tabla_tarjeta SET
		Tarjeta_monto_cuotas = '$tarjeta_monto_cuotas',
		Tarjeta_monto_intereses = '$tarjeta_monto_intereses',
		Tarjeta_modif_fecha = CURRENT_DATE,
		Tarjeta_modif_usuario = '$idUsuario'
		WHERE Tarjeta_nro = $idTarjeta";
		
		if(mysql_query($sql)) { ?>
<h2>Los datos fueron actulizados correctamente</h2>        
       
        <? }else{ ?>

<h2>No se pudo actualizar la tarjeta. Por favor contacte al administrador</h2>         

<? } ?>

<p><a href="tarjeta-pagos-historial.php?idTarjeta=<? echo $idTarjeta; ?>&idFamilia=<? echo $idFamilia ?>


beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? include("pie.php");