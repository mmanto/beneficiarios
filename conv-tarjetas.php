<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$fila = '1';

$sql = "SELECT * FROM dbo_familia WHERE Familia_tarjeta_nro != '0' AND blnConv3 = '0' LIMIT 0,50";
$res = mysql_query($sql);

while ($familia = mysql_fetch_array($res)) {
$familia_nro = $familia["Familia_nro"];

$tarjeta_numero = $familia["Familia_tarjeta_nro"];
$tarjeta_alta_fecha = $familia["Familia_tarjeta_fecha"];
$tarjeta_monto_origen = $familia["Familia_montoadj"];
$cuotas_cant = $familia["Familia_montoadj_cuotas"];
$tarjeta_monto_pago = $familia["Familia_montoadj_pago"];
$tarjeta_monto_actual = $familia["Familia_monto_actualizacion"];
$tarjeta_cancelacion_monto = $familia["Familia_cancelacion_monto"];
$tarjeta_cancelacion_fecha = $familia["Familia_cancelacion_fecha"];


$sql2 = "SELECT * FROM dbo_persona WHERE Familia_nro = $familia_nro AND blnActivo = '1' AND Persona_baja != '1' ORDER BY Persona_nro ASC LIMIT 0,1";
$res2 = mysql_query($sql2);
$persona = mysql_fetch_array($res2);
$persona_nro = $persona["Persona_nro"];
$persona_nombre = $persona["Persona_nombre"];
$persona_apellido = $persona["Persona_apellido"];


$sql3 = "INSERT INTO dbo_tarjeta (
		Tarjeta_numero,
		Tarjeta_titular_apellido,
		Tarjeta_titular_nombre,
		Tarjeta_alta_fecha,
		Tarjeta_monto_origen,
		Tarjeta_monto_cuotas,
		Tarjeta_monto_actual,
		Tarjeta_monto_pago,
		Tarjeta_cancelacion_monto,
		Tarjeta_cancelacion_fecha,
		Persona_nro
		)VALUES(
		'$tarjeta_numero',
		'$persona_apellido',
		'$persona_nombre',
		'$tarjeta_alta_fecha',
		'$tarjeta_monto_origen',
		'$cuotas_cant',
		'$tarjeta_monto_actual',
		'$tarjeta_monto_pago',
		'$tarjeta_cancelacion_monto',
		'$tarjeta_cancelacion_fecha',
		'$persona_nro')";

if(mysql_query($sql3)) { echo $fila." - ".$tarjeta_numero." - OK</br>"; 

$sql4 = "UPDATE dbo_familia SET blnConv3 = '1' WHERE Familia_nro = $familia_nro";

if(mysql_query($sql4)) {


}}else{ echo $tarjeta_numero." - ERROR</br>"; }



 echo $fila." - ".$tarjeta_numero." - OK</br>";

$fila++;

//Cierre del while
}