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

$fp = fopen ("Chacabuco-2017-02.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '1';

$row = 0;

$barrio_nro = '377';

$partido = '26';

$familia_id_migra = '20170703';


// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$lote_circ = "I";
		$lote_secc = "K";



		$lote_manzana = $data[0];
		$lote_parcela = $data[1];
		
		$b1_apellido = $data[2];
		$b1_nombre = $data[3];
		$b1_documento = $data[4];
		$b1_nacionalidad = $data[5];
		$b1_fechanac = $data[6];
		$b1_padre = $data[7];
		$b1_madre = $data[8];
		
		$b2_apellido = $data[9];
		$b2_nombre = $data[10];
		$b2_documento = $data[11];
		$b2_nacionalidad = $data[12];
		$b2_fechanac = $data[13];
		$b2_padre = $data[14];
		$b2_madre = $data[15];
		$domicilio = $data[16];


	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Barrio_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_manzana,
	Lote_parcela,
	Partido_nro,
	insert_fecha,
	insert_usuario,
	insert_tipo,
	Familia_idmigra
	)VALUES(
	'$barrio_nro',
	'$lote_circ',
	'$lote_secc',
	'$lote_manzana',
	'$lote_parcela',
	'$partido',
	CURRENT_DATE,
	'1',
	'2',
	'$familia_id_migra')";	
		
	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	
	// Insercion del titular 1

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
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
	'$b2_fechanac',
	'$b2_padre',
	'$b2_madre',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst2,$link);
	

		echo "$row - Migración exitosa! <br>";
	
		
	}else{
	echo "No se pudo realizar la insercion.";
	$error++;
	}
	
	

		

	}  //Este es el fin del while

echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	