<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Migracion</title>
</head>

<body>
<?php

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

//////////////////////////////////////////

$fp = fopen ("SanPedro2017.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '1';

$row = 0;

$barrio_nro = '36';

$partido = '99';

$familia_id_migra = '20170817';


// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$lote_circ = $data[17];
		$lote_secc = $data[18];		
		$lote_qta = $data[19];
		$lote_manzana = $data[15];
		$lote_parcela = $data[16];
		$lote_plano = $data[20];
		$lote_domic = $data[14];
		$observaciones = $data[21];	
		
		$b1_documento = $data[2];
		$b1_apellido = $data[0];
		$b1_nombre = $data[1];
		$b1_nacionalidad = $data[3];
		$b1_fechanac = $data[4];
		$b1_padre = $data[5];
		$b1_madre = $data[6];	
		
		$b2_documento = $data[9];
		$b2_apellido = $data[7];
		$b2_nombre = $data[8];
		$b2_nacionalidad = $data[10];
		$b2_fechanac = $data[11];
		$b2_padre = $data[12];
		$b2_madre = $data[13];
		

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Barrio_nro,
	Familia_apellido,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_quinta,
	Lote_manzana,
	Lote_parcela,
	Plano_num,
	Plano_aprobado,
	Plano_registrado,
	Partido_nro,
	Familia_domic,
	Familia_observaciones,
	insert_fecha,
	insert_usuario,
	insert_tipo,
	Familia_idmigra
	)VALUES(
	'$barrio_nro',
	'$b1_apellido',
	'$lote_circ',
	'$lote_secc',
	'$lote_ch',
	'$lote_manzana',
	'$lote_parcela',
	'$lote_plano',
	'1',
	'1',
	'$partido',
	'$lote_domic',
	'$observaciones',
	CURRENT_DATE,
	'3',
	'2',
	'$familia_id_migra')";	
		
	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	
	}else{
	echo "No se pudo realizar la insercion de familia ($persona_nombre_completo)";
	$error++;
	}
	
	

	
// Insercion del titular 1

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Persona_nacionalidad,
	Persona_fecha_nac,
	Persona_padre_apellido,
	Persona_madre_apellido,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b1_apellido',
	'$b1_nombre',
	'1',
	'$b1_documento',
	'$b1_nacionalidad',
	'$b1_fechanac',
	'$b1_padre',
	'$b1_madre',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst1,$link);
	
// Insercion del titular 2

	$inst2 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Persona_nacionalidad,
	Persona_fecha_nac,
	Persona_padre_apellido,
	Persona_madre_apellido,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b2_apellido',
	'$b2_nombre',
	'1',
	'$b2_documento',
	'$b2_nacionalidad',
	'$b2_fechanac',
	'$b2_padre',
	'$b2_madre',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst2,$link);
	

		echo "$row - Migración exitosa! <br>";

	}  //Este es el fin del while

echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	