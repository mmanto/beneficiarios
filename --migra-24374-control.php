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

$fp = fopen ("24374-Control.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

	 $dbo_tabla_tramite = "dbo_tramite_ley_control";
	 $dbo_tabla_persona = "dbo_persona_control";

//////////////////////////////////////////////

//Variables comnunes
//$direccion_nro = '2';

$row = 0;

//$barrio_nro = '219';

//$partido = '99';

$tramite_id_migra = '20170418';



// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 300000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$fecha_inicio = $data[0];
		$tipo_tramite = $data[1];
		$partido = $data[2];
		$nomenc = $data[3];
		$apellido = $data[4];
		$nombre = $data[5];
		$dni = $data[6];
		$telefono = $data[7];
		$completo = $data[8];
		$observaciones = $data[9];
		$cedula = $data[10];
		$plancheta = $data[11];
		$infdominio = $data[12];
		$edicto = $data[13];
		$camara = $data[14];
		$sumacontrol = $data[15];
		$escribano = $data[16];
	
		
		
	$insFlia = "INSERT INTO $dbo_tabla_tramite (
	Tramite_inicio_fecha,
	Tramite_partido,
	Tramite_nomenc,
	Tramite_completo,
	Tramite_cedula,
	Tramite_plancheta,
	Tramite_inf_dom,
	Tramite_suma_control,
	Tramite_archivado,
	Tramite_observaciones,
	Tramite_escribano,
	Tramite_numref,
	Tramite_alta_usuario,
	Tramite_alta_fecha,
	Tramite_id_migra
	)VALUES(
	'$fecha_inicio',
	'$partido',
	'$nomenc',
	'$completo',
	'$cedula',
	'$plancheta',
	'$infdominio',
	'$sumacontrol',
	'0',
	'$observaciones',
	'$escribano',
	'0',
	'1',
	CURRENT_DATE,
	'$tramite_id_migra')";	
		
	if (mysql_query($insFlia,$link)) {
	$Tramite_nro = mysql_insert_id();
	
	}else{
	echo "No se pudo realizar la insercion de tramite";
	$error++;
	}
	
// Insercion del titular 1

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Persona_telefono,
	Tramite_nro,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$apellido',
	'$nombre',
	'1',
	'$dni',
	'$telefono',
	'$Tramite_nro',
	'0',
	'$tramite_id_migra')";
	
	mysql_query($inst1,$link);

		echo "$row - Migración exitosa! <br>";

	}  //Este es el fin del while

//$del = "DELETE FROM dbo_persona WHERE Persona_dni_nro = '33333333' and Persona_apellido LIKE 'mouse'";

//if(mysql_query($del)) { echo "<p>Extras eliminados</p>";}else{ echo "<p>Extras NO eliminados</p>"; }


echo "<h2>Proceso finalizado</h2>";
?>
</body>
</html>	