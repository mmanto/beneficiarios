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

$fp = fopen ("monte-201809-02.txt","r"); 

/////////////////////////////////////////

// Definici�n nombres de tablas

	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '1';

$row = 0;

$partido = '73';

$barrio_nro = '177';

$familia_id_migra = '20180927-01';


// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		
	
		$lote_circ = $data[22];
		$lote_secc = $data[23];
		$lote_chacra = $data[24];
		
		$lote_manzana = $data[17];
		$lote_parcela = $data[18];
		$lote_plano = $data[25];
		$lote_domic = $data[16];
		$lote_plano_fecha = $data[26];
		$lote_decreto_compra = $data[27];
		$observaciones = $data[19];
		$lote_valor = $data[20];
		$lote_valor_cuotas = $data[21];	
		
		$b1_documento = $data[2];
		$b1_apellido = $data[0];
		$b1_nombre = $data[1];
		$b1_nacionalidad = $data[3];
		$b1_fechanac = $data[4];
		$b1_padre = $data[5];
		$b1_madre = $data[6];	
		$b1_ecivil = $data[7];		
		
		$b2_documento = $data[10];
		$b2_apellido = $data[8];
		$b2_nombre = $data[9];
		$b2_nacionalidad = $data[11];
		$b2_fechanac = $data[12];
		$b2_padre = $data[13];
		$b2_madre = $data[14];	
		$b2_ecivil = $data[15];
		

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Barrio_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_manzana,
	Lote_parcela,
	Familia_montoadj,
	Familia_montoadj_cuotas,
	Familia_decreto_compra,
	Plano_num,
	Plano_aprobado_fecha,
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
	'$lote_circ',
	'$lote_secc',
	'$lote_chacra',
	'$lote_manzana',
	'$lote_parcela',
	'$lote_valor',
	'$lote_valor_cuotas',
	'$lote_decreto_compra',
	'$lote_plano',
	'$lote_plano_fecha',
	'1',
	'1',
	'$partido',
	'$lote_domic',
	'$observaciones',
	CURRENT_DATE,
	'2',
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
	Estado_civil_nro,
	Persona_fecha_nac,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b1_apellido',
	'$b1_nombre',
	'1',
	'$b1_documento',
	'$b1_nacionalidad',
	'$b1_ecivil',
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
	Estado_civil_nro,
	Persona_fecha_nac,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$b2_apellido',
	'$b2_nombre',
	'1',
	'$b2_documento',
	'$b2_nacionalidad',
	'$b2_ecivil',
	'$b2_fechanac',
	'$b2_padre',
	'$b2_madre',
	'$Familia_nro',
	'$familia_id_migra')";
	
	mysql_query($inst2,$link);
	

		echo "$row - Migraci&aacute;n exitosa! <br>";

	}  //Este es el fin del while

echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	