<? session_start();

$idUsuario = $_SESSION["user_id"];

///////////////////////////////////////
$tabla_tarjeta = "dbo_tarjeta";
$tabla_pagos = "dbo_tarjeta_rendicion";
///////////////////////////////////////

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

if(!$_POST["archivo"] || !$_POST["textArea"]) { ?>

<h2>Debe completar todos los campos</h2>	
<p><a href="rendicion-alta-form.php">Volver</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>	
	
<? }else{

$archivo = $_POST["archivo"];
$valida_archivo = substr($archivo, 0, 8);
$textArea = $_POST["textArea"];
$fila = "0";

//Compruebo que el nombre de archivo sea valido

if($valida_archivo != "62000149") { ?>

<h2>El nombre de archivo no es v&aacute;lido.</h2>	
<p><a href="rendicion-alta-form.php">Volver</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
	
<? }else{

//Compruebo que el archivo actual no haya sido aun procesado

$res789 = mysql_query("SELECT * FROM $tabla_pagos WHERE Archivo = '$archivo'");

if(mysql_num_rows($res789) != '0') { ?>

<h2>El archivo <?=$archivo; ?>.txt ya fue procesado con anterioridad.</h2>	
<p><a href="rendicion-alta-form.php">Volver</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
	
<? }else{

$textArea = explode("\n", $textArea);
$i = 0;

foreach($textArea as $cadena)
{

$valida = substr($cadena, 0, 5);
$sucursal = substr($cadena, 28, 4);
$terminal = substr($cadena, 14, 4);
$transaccion = substr($cadena, 42, 6);
$txt_tarjeta = substr($cadena, 164, 18);
$monto = substr($cadena, 81, 7)/100;
$monto = number_format($monto, 2, '.', '');
$fecha_dia = substr($cadena, 228, 2);
$fecha_mes = substr($cadena, 226, 2);
$fecha_anio = substr($cadena, 224, 2);
if($fecha_anio > 70) { $fecha_anio = "19".$fecha_anio; }else{$fecha_anio = "20".$fecha_anio; }
$fecha = $fecha_anio."-".$fecha_mes."-".$fecha_dia;



	
if($txt_tarjeta != '0' && $valida == "DATOS") {

$res = mysql_query("SELECT * FROM $tabla_tarjeta WHERE Tarjeta_numero = '$txt_tarjeta'");

if(mysql_num_rows($res) != '0') {

// Buscar tarjeta, recuperar id y actualizar monto pagado	

$tarjeta = mysql_fetch_array($res);

$tarjeta_nro = $tarjeta["Tarjeta_nro"];
$tarjeta_monto_pago	 = $tarjeta["Tarjeta_monto_pago"];

$tarjeta_nuevo_monto = $tarjeta_monto_pago + $monto;

$upd = "UPDATE $tabla_tarjeta SET Tarjeta_monto_pago = '$tarjeta_nuevo_monto' WHERE Tarjeta_nro = $tarjeta_nro";

$res2 = mysql_query($upd);


	
}else{

// Dar alta nueva tarjeta y recuperar id
	
$ins = "INSERT INTO $tabla_tarjeta (
		Tarjeta_numero,
		Tarjeta_monto_pago,
		Tarjeta_alta_fecha,
		Tarjeta_alta_usuario,
		Archivo,
		Persona_nro
		)VALUES(
		'$txt_tarjeta',
		'$monto',
		CURRENT_DATE,
		'$idUsuario',
		'$archivo',
		'0'
		)";	
		
if (mysql_query($ins)) { $tarjeta_nro = mysql_insert_id(); }else{ echo "NO se pudo procesar alta de tarjeta"; }


}
// Insertar el registro de pagos

$ins2 = "INSERT INTO $tabla_pagos (
		Pago_fecha,
		Pago_sucursal,
		Pago_terminal,
		Pago_transaccion,
		Pago_monto,
		Archivo,
		Rendicion_alta_fecha,
		Rendicion_alta_usuario,
		Tarjeta_nro
		)VALUES(
		'$fecha',
		'$sucursal',
		'$terminal',
		'$transaccion',
		'$monto',
		'$archivo',
		CURRENT_DATE,
		'$idUsuario',
		'$tarjeta_nro')";

if(!mysql_query($ins2)) { echo "ERROR AL PROCESAR PAGO</br>";
	echo $txt_tarjeta." - Pago: ".$monto." - Fecha: ".$fecha." - Sucursal: ".$sucursal." - Terminal: ".$terminal. " - Transaccion: ".$transaccion."<br>";	}

$fila++;

//Fin del foreach
}} ?>
<h2>El archivo <?=$archivo; ?> fue procesado con &eacute;xito.</h2>
<p><?=$fila." pagos registrados"; ?></p>	
<p><a href="rendicion-alta-form.php">Cargar otra rendicion</a> | <a href="sbt-menu.php">Volver al menu</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
//Cierre del if por si el archivo ya habia sido procesado
}}}

include("pie.php");

?>