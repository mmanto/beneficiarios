<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


$direccion_nro = '1';

$barrio_nro = $_POST["barrio_nro"];

$sql = "SELECT Partido_nro from dbo_barrio WHERE Barrio_nro = $barrio_nro ";

$res = mysql_query($sql);

$partido = mysql_fetch_array($res);

$partido_nro = $partido["Partido_nro"];

$beneficio_origen = $_POST["beneficio_origen"];

$familia_id_migra = $_POST["idMigracion"];

$archivo = $_POST["archivo_nombre"];

$row = 0;


// Procesamiento

if ($fp = fopen ($archivo,"r")) { 

// Definición nombres de tablas

	 $dbo_tabla_familia = "dbo_familia_test";
	 $dbo_tabla_persona = "dbo_persona_test";



// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 
		$lote_circ = $data[0];
		$lote_secc = $data[1];
		$lote_ch = $data[2];
		$lote_manzana = $data[3];
		$lote_parcela = $data[4];
		$b1_apellido = $data[5];
		$b1_nombre = $data[6];
		$b1_documento = $data[7];
		$b2_apellido = $data[8];
		$b2_nombre = $data[9];
		$b2_documento = $data[10];
		$observaciones = $data[11];
			

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Barrio_nro,
	Familia_apellido,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_manzana,
	Lote_parcela,
	Partido_nro,
	Familia_beneficio_origen,
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
	'$partido',
	'$beneficio_origen',
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

}else{ echo "No se encuentra el archivo"; }