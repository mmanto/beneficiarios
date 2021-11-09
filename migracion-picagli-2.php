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

$fp = fopen ("picagli-2.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '2';

$row = 0;

$barrio_nro = '219';

$partido = '99';

$familia_id_migra = '201703092';



// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 300000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$b1_apellido = $data[0];
		$b1_nombre = $data[1];
		$b1_documento = $data[2];
		$b1_nacionalidad = $data[3];
		$b1_nacim = $data[4];
		$b1_padre = $data[5];
		$b1_madre = $data[6];
		$b1_ecivil = $data[7];
		$b2_apellido = $data[8];
		$b2_nombre = $data[9];
		$b2_documento = $data[10];
		$b2_nacionalidad = $data[11];
		$b2_nacim = $data[12];
		$b2_padre = $data[13];
		$b2_madre = $data[14];
		$b2_ecivil = $data[15];
		$familia_domic = $data[16];
		$lote_circ = $data[17];
		$lote_secc = $data[18];
		$lote_qta = $data[19];	
		$lote_manzana = $data[20];
		$lote_parcela = $data[21];		
		
		
	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Familia_beneficio_origen,
	Barrio_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_quinta,
	Lote_manzana,
	Lote_parcela,
	Partido_nro,
	Familia_domic,
	insert_fecha,
	insert_usuario,
	insert_tipo,
	Familia_idmigra
	)VALUES(
	'$direccion_nro',
	'$barrio_nro',
	'$lote_circ',
	'$lote_secc',
	'$lote_qta',
	'$lote_manzana',
	'$lote_parcela',
	'$partido',
	'$familia_domic',
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
	Estado_civil_nro,
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
	'$b1_ecivil',
	'$b1_nacionalidad',
	'$b1_nacim',
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
	Estado_civil_nro,
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
	'$b2_ecivil',
	'$b2_nacionalidad',
	'$b2_nacim',
	'$b2_padre',
	'$b2_madre',	
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst2,$link);
	

		echo "$row - Migración exitosa! <br>";

	}  //Este es el fin del while

$del = "DELETE FROM dbo_persona WHERE Persona_dni_nro = '33333333' and Persona_apellido LIKE 'mouse'";

if(mysql_query($del)) { echo "<p>Extras eliminados</p>";}else{ echo "<p>Extras NO eliminados</p>"; }


echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	