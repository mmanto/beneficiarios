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

$archivo = "migra-20190424-01.txt";

$fp = fopen ($archivo,"r"); 

$familia_idMigra = $archivo;

/////////////////////////////////////////

// Definici�n nombres de tablas

$dbo_tabla_familia = "dbo_familia";
$dbo_tabla_persona = "dbo_persona";

/////////////////////////////////////////

//Busca si el archivo ya fue procesado

$sql2 = "SELECT * FROM $dbo_tabla_familia WHERE Familia_idmigra = '$archivo'";

$res2 = mysql_query($sql2);

$cant = mysql_num_rows($res2);

if ($cant > 0) { echo "<h2>El archivo ya fue procesado</h2>"; }else{


//Variables comnunes
$direccion_nro = '1';

$row = 0;

// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		
		$lote_partido = $data[0];
		$lote_barrio = $data[1];	
		$lote_circ = $data[2];		
		$lote_secc = $data[3];
		$lote_chacra = $data[4];
		$lote_quinta = $data[5];
		$lote_fraccion = $data[6];		
		$lote_manzana = $data[7];
		$lote_parcela = $data[8];
		$lote_plano = $data[9];		
		$b1_documento = $data[10];
		$b1_apellido = $data[11];
		$b1_nombre = $data[12];
		$b1_padre = $data[13];
		$b1_madre = $data[14];		
		$b2_documento = $data[15];
		$b2_apellido = $data[16];
		$b2_nombre = $data[17];
		$b2_padre = $data[18];
		$b2_madre = $data[19];	
		$b2_ecivil = $data[15];
		$observaciones = $data[20];
		$fecha_boleto_cv = $data[21];
		$escritura_num = $data[22];
		$escritura_fecha_origen = $data[23];
		$matricula = $data[24];

if($fecha_boleto_cv == '0') { $blnBoleto = '0'; }else{ $blnBoleto = '1'; } 		

$escritura_fecha = cambiaf_a_mysql($escritura_fecha_origen);

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Partido_nro,
	Barrio_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Plano_num,
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
	'$lote_partido',
	'$lote_barrio',
	'$lote_circ',
	'$lote_secc',
	'$lote_chacra',
	'$lote_quinta',
	'$lote_fraccion',
	'$lote_manzana',
	'$lote_parcela',
	'$lote_plano',
	'$observaciones',
	'$blnBoleto',
	'$fecha_boleto_cv',
	'$escritura_num',
	'$escritura_fecha',
	'$matricula',
	CURRENT_DATE,
	'2',
	'2',
	'$familia_idMigra')";	
		
	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();

echo "Familia insertada - ";


// Si se pudo insertar la familia 
// Insercion del titular 1

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Estado_civil_nro,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b1_apellido',
	'$b1_nombre',
	'1',
	'$b1_documento',
	'$b1_padre',
	'$b1_madre',
	'10',
	'$Familia_nro',
	'$familia_idMigra')";
	
	if(mysql_query($inst1,$link)) { echo "Persona 1 migrada OK - "; }else{ echo "Error al insertar persona. DNI: ".$b2_documento." "; } 
	
// Insercion del titular 2

	$inst2 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Estado_civil_nro,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b2_apellido',
	'$b2_nombre',
	'1',
	'$b2_documento',
	'$b2_padre',
	'$b2_madre',
	'10',
	'$Familia_nro',
	'$familia_idMigra')";
	
	if(mysql_query($inst2,$link)) { echo "Persona 2 migrada OK - "; }else{ echo "Error al insertar persona. DNI: ".$b2_documento." "; } 
		
	}else{
	echo "No se pudo realizar la insercion de familia";
	$error++;
	}
	
echo "<br>";

	}  //Este es el fin del while

$sql = "DELETE FROM dbo_persona WHERE Persona_dni_nro = '33333333' AND Persona_apellido LIKE 'Mouse'";

$res = mysql_query($sql);


echo "<h2>Proceso finalizado</h2>";

}

?>
</body>
</html>	