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

$fp = fopen ("EspGde02.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '1';

$row = 0;

$barrio_nro = '7';

$partido = '86';

$familia_id_migra = '20170915';


// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$lote_circ = $data[0];
		$lote_secc = $data[1];		
		$lote_manzana = $data[2];
		$lote_manzana_prov = $data[3];
		$lote_parcela = $data[4];
		$b1_apellido = $data[5];
		$b1_nombre = $data[6];
		$b1_doc_tipo = $data[7];
		$b1_documento = $data[8];
		$b2_apellido = $data[9];
		$b2_nombre = $data[10];
		$b2_doc_tipo = $data[11];
		$b2_documento = $data[12];
		$observaciones = $data[13];
		$resolucion = $data[14];
		$monto = $data[15];
		
		

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Barrio_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_manzana,
	Lote_manzana_prov,
	Lote_parcela,
	Familia_observaciones,
	Familia_res_adj,
	Familia_montoadj,
	insert_fecha,
	insert_usuario,
	insert_tipo,
	Familia_idmigra
	)VALUES(
	'$barrio_nro',
	'$lote_circ',
	'$lote_secc',
	'$lote_manzana',
	'$lote_manzana_prov',
	'$lote_parcela',
	'$observaciones',
	'$resolucion',
	'$monto',
	CURRENT_DATE,
	'1',
	'2',
	'$familia_id_migra')";	
		
	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	
	}else{
		
	echo "No se pudo realizar la insercion de familia";
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
	'$b1_doc_tipo',
	'$b1_documento',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst1,$link);
	
// Insercion del titular 2 (si lo hay)

	if($b2_documento != '111') {
	
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
	'$b2_doc_tipo',
	'$b2_documento',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst2,$link);

	}

		echo "$row - Migración exitosa! <br>";

	}  //Este es el fin del while

echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	