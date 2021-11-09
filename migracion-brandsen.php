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

$fp = fopen ("Brandsen-02.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '1';

$row = 0;

$barrio_nro = '247';

$partido = '13';

$familia_id_migra = '20170615';


// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$lote_circ = $data[1];
		$lote_secc = $data[2];
		$lote_chacra = $data[3];
		$lote_quinta = $data[4];
		$lote_fraccion = $data[5];
		$lote_manzana = $data[6];
		$lote_parcela = $data[7];
		$lote_plano = $data[8];
		$PFPestado = $data[9];
		$b1_documento = $data[10];
		$b1_apellido = $data[11];
		$b1_nombre = $data[12];
		$b2_documento = $data[13];
		$b2_apellido = $data[14];
		$b2_nombre = $data[15];
		$observaciones = $data[16];
		$fecha_boleto = $data[17];
		$escritura_numero = $data[18];
		//$escritura_fecha = $data[19];
		$matricula = $data[20];
		
$familia_escritura_fecha = cambiaf_a_mysql($data[19]);

if($fecha_boleto != '0') {$blnBoleto = '1'; }else{ $blnBoleto = '0';}


	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Barrio_nro,
	Familia_apellido,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Partido_nro,
	Plano_num,
	PFP_estado,
	Familia_observaciones,
	blnBoleto,
	Boleto_fecha,
	Familia_escritura,
	Familia_escritura_fecha,
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
	'$lote_chacra',
	'$lote_quinta',
	'$lote_fraccion',
	'$lote_manzana',
	'$lote_parcela',
	'$partido',
	'$lote_plano',
	'$PFPestado',
	'$observaciones',
	'$blnBoleto',
	'$fecha_boleto',
	'$escritura_numero',
	'$familia_escritura_fecha',
	'$matricula',	
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
	
		
	}else{
	echo "No se pudo realizar la insercion.";
	$error++;
	}
	
	

		

	}  //Este es el fin del while

echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	