<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Migracion</title>
</head>

<body>
<?php

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

//////////////////////////////////////////

$fp = fopen ("navarro.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '1';

$row = 0;

$barrio_nro = '156';

$partido = '75';

$familia_id_migra = '201504162';


// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$lote_circ = $data[0];
		$lote_secc = $data[1];
		$lote_ch = $data[2];
		$lote_qta = $data[3];
		$lote_manzana = $data[4];
		$lote_parcela = $data[5];
		$b1_apellido = $data[6];
		$b1_nombre = $data[7];
		$b1_documento = $data[8];
		$b2_apellido = $data[9];
		$b2_nombre = $data[10];
		$b2_documento = $data[11];
		$lote_matricula = $data[12];	


/*
echo $b1_apellido.", ".$b1_nombre." - ".$b1_documento." - ".$b1_fecha_nac." ////// ".$b2_apellido.", ".$b2_nombre." - ".$b2_documento." - ".$b2_fecha_nac." <strong>I.C.:</strong> Manzana:".$lote_manzana." - Pc.".$lote_parcela."<br>"; 
*/		
	

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Barrio_nro,
	Familia_apellido,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_quinta,
	Lote_manzana,
	Lote_parcela,
	Partido_nro,
	Familia_matricula,
	insert_fecha,
	insert_usuario,
	insert_tipo,
	Familia_idmigra
	)VALUES(
	'$barrio_nro',
	'$b1_apellido',
	'$lote_circ',
	'$lote_secc',
	$lote_qta,	
	'$lote_manzana',
	'$lote_parcela',
	'$partido',
	'$lote_matricula',
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
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b1_apellido',
	'$b1_nombre',
	'1',
	'$b1_documento',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst1,$link);
	
// Insercion del titular 2

	$inst2 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b2_apellido',
	'$b2_nombre',
	'1',
	'$b2_documento',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst2,$link);
	

		echo "$row - Migración exitosa! <br>";
		

	}  //Este es el fin del while

echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	