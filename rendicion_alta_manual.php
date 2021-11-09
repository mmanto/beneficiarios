<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{
	
///////////////////////////////////////
$tabla_tarjeta = "dbo_tarjeta";
$tabla_pagos = "dbo_tarjeta_rendicion";
///////////////////////////////////////

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

$idFamilia = $_POST["idFamilia"];
$idTarjeta = $_POST["idTarjeta"];
$pago_fecha_dia = $_POST["pago_fecha_dia"];
$pago_fecha_mes = $_POST["pago_fecha_mes"];
$pago_fecha_anio = $_POST["pago_fecha_anio"];
$pago_fecha = $pago_fecha_anio."-".$pago_fecha_mes."-".$pago_fecha_dia;
$pago_sucursal = $_POST["pago_sucursal"];
$pago_terminal = $_POST["pago_terminal"];
$pago_transaccion = $_POST["pago_transacción"];
$pago_monto_entero = $_POST["pago_monto_entero"];
$pago_monto_decimal = $_POST["pago_monto_decimal"];
$pago_monto = $pago_monto_entero.".".$pago_monto_decimal;
$rendicion_tipo = '2';

//Para control
/*
<p>Usuario: <?=$idUsuario; ?></p>
<p>Familia: <?=$idFamilia; ?></p>
<p>Tarjeta: <?=$idTarjeta; ?></p>
<p>Pago fecha: <?=$pago_fecha; ?></p>
<p>Sucursal: <?=$pago_sucursal; ?></p>
<p>Terminal: <?=$pago_terminal; ?></p>
<p>Transaccion: <?=$pago_transaccion; ?></p>
<p>Monto: $ <?=$pago_monto; ?></p>
<p>Tipo rend: <?=$rendicion_tipo; ?>
<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver</a>

*/

$res = mysql_query("SELECT * FROM dbo_tarjeta WHERE Tarjeta_numero = $idTarjeta");

$tarjeta = mysql_fetch_array($res);

$tarjeta_monto_pago	 = $tarjeta["Tarjeta_monto_pago"];

$tarjeta_nuevo_monto = $tarjeta_monto_pago + $pago_monto;

$upd = "UPDATE $tabla_tarjeta SET Tarjeta_monto_pago = '$tarjeta_nuevo_monto' WHERE Tarjeta_nro = $idTarjeta";

$res2 = mysql_query($upd);


$sql = "INSERT INTO $tabla_pagos (
		Pago_fecha,
		Pago_sucursal,
		Pago_terminal,
		Pago_transaccion,
		Pago_monto,
		Archivo,
		Rendicion_tipo,
		Rendicion_alta_fecha,
		Rendicion_alta_usuario,
		Tarjeta_nro
		)VALUES(
		'$pago_fecha',
		'$pago_sucursal',
		'$pago_terminal',
		'$pago_transaccion',
		'$pago_monto',
		'--',
		'2',
		CURRENT_DATE,
		'$idUsuario',
		'$idTarjeta')";

if(!mysql_query($sql)) { echo "<h2>No se pudo realizar el alta del pago. Contacte al administrador</h2>";

}else{

//// Actualizacion del monto pago
	
$res = mysql_query("SELECT * FROM dbo_tarjeta WHERE Tarjeta_nro = '$idTarjeta'");

$count = mysql_num_rows($res);

$tarjeta = mysql_fetch_array($res);

$tarjeta_monto_pago	 = $tarjeta["Tarjeta_monto_pago"];

$tarjeta_nuevo_monto = $tarjeta_monto_pago + $pago_monto;

$upd = "UPDATE $tabla_tarjeta SET Tarjeta_monto_pago = '$tarjeta_nuevo_monto' WHERE Tarjeta_nro = $idTarjeta";

$res2 = mysql_query($upd);

////
	
	echo "<h2>El pago se ha registrado correctametne</h2>";
	echo "<h2>Cant.: ".$count."</h2>";
	echo "<h2>Tarjeta: ".$idTarjeta."</h2>";
	echo "<h2>Registrado: ".$tarjeta_monto_pago."</h2>";
	echo "<h2>Pago actual: ".$pago_monto."</h2>";
	echo "<h2>Total con pago actual: ".$tarjeta_nuevo_monto."</h2>";
} ?>
<p><a href="tarjeta-pagos-historial.php?idTarjeta=<?=$idTarjeta; ?>&idFamilia=<?=$idFamilia; ?>">Volver</a>
		
<? } ?>