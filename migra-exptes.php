<?php

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

//VARIABLES PROPIAS

$idMigra = "0001";

//

$sql = "SELECT * FROM dbo_expte_esc WHERE Migrado ='0' ORDER BY Expte_nro LIMIT 0,100";
$res = mysql_query($sql);

while ($expte_origen = mysql_fetch_array($res)) {


$expteorig_nro = $expte_origen["Expte_nro"];

$expteorig_caract = $expte_origen["Expte_caract"];
$expteorig_numero = $expte_origen["Expte_num"];
$expteorig_anio = $expte_origen["Expte_anio"];
$expteorig_alcance = $expte_origen["Expte_alcance"];
$expteorig_cuerpos = $expte_origen["Expte_cuerpo"];

$expteorig_extracto = $expte_origen["Expte_esc_extracto"]; 

$expteorig_partido = $expte_origen["idPartido"];
$expteorig_barrio = $expte_origen["Barrio_nro"];
$expteorig_salida = $expte_origen["Expte_envio_egg"];
$expteorig_salida_destino = $expte_origen["Expte_salida_destino"];


$expteorig_ubicacion_area =  $expte_origen["Expte_ubicacion_area"];
$expteorig_ubicacion_direccion =  $expte_origen["Expte_ubicacion_direccion"];
$expteorig_ubicacion_detalle =  $expte_origen["Expte_mov"];
$expteorig_ubicacion_detalle_fecha =  $expte_origen["Expte_fechamov"];

$expteorig_detalle = $expte_origen["Expte_mov"];
$expteorig_detalle_fecha = $expte_origen["Expte_fechamov"];

$expteorig_beneficios = $expte_origen["Expte_beneficios"];
$expteorig_observaciones = $expte_origen["Expte_observaciones"];


$sql2 = "INSERT INTO dbo_exptes (
		Expte_alta_fecha,
		Expte_alta_hora,
		Expte_alta_usuario,
		Expte_caract,
		Expte_partido,
		Expte_rnrd,
		Expte_num,
		Expte_anio,
		Expte_alcance,
		Expte_cuerpos_cant,
		Expte_extracto,
		Expte_24374,
		Expte_ley_cons,
		Expte_esc,
		Expte_origen,
		Partido_nro,
		Barrio_nro,
		Expte_salida,
		Expte_salida_destino,
		Expte_fojas_origen,
		Expte_fojas_actual,
		Expte_ubicacion_area,
		Expte_ubicacion_direccion,
		Expte_ubicacion_pendiente,
		Expte_ubicacion_detalle,
		Expte_ubicacion_detalle_fecha,
		Expte_beneficios,
		Expte_observaciones,
		idMigra,
		Fecha_migra,
		blnActivo		
		)VALUES(
		CURRENT_DATE,
		CURRENT_TIME,
		'1',
		'$expteorig_caract',
		'0',
		'0',
		'$expteorig_numero',
		'$expteorig_anio',
		'$expteorig_alcance',
		'$expteorig_cuerpos',
		'$expteorig_extracto',
		'0',
		'0',
		'1',
		'83',
		'$expteorig_partido',
		'$expteorig_barrio',
		'$expteorig_salida',
		'$expteorig_salida_destino',
		'0',
		'0',
		'$expteorig_ubicacion_area',
		'$expteorig_ubicacion_direccion',
		'0',
		'$expteorig_detalle',
		'$expteorig_detalle_fecha',
		'$expteorig_beneficios',
		'$expteorig_observaciones',
		'$idMigra',
		CURRENT_DATE,
		'1'		
		)";
		
		
if(!mysql_query($sql2)) { echo "ERROR</br>"; }else{


$insExpte = mysql_insert_id($link);


$sql3 = "UPDATE dbo_familia SET 
		Expte_esc_nro_nw = '$insExpte' 
		WHERE Expte_esc_nro = $expteorig_nro";


if(mysql_query($sql3)) {

$sql4 = "UPDATE dbo_expte_esc SET 
		Migrado = '1' 
		WHERE Expte_nro = $expteorig_nro";


if(mysql_query($sql4)) {

 echo "Registro actualizado. Id alta: ".$insExpte."</br>"; }else{ echo "ERROR</br>"; }
}}
} //cierre del while