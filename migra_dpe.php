<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Migracion ley 24.374</title>
</head>

<body>
<?php
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$tiempoinicial = $mtime; 

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

//////////////////////////////////////////

$id_migra = '1999_79';

$fp = fopen ("txt/1999/1999_79.txt","r"); 

/////////////////////////////////////////

// Definición nombres de tablas

     $dbo_tabla_lote = "dbo_lote";
	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";
	 $dbo_tabla_escritura = "dbo_escritura";

//////////////////////////////////////////////

//Variables comnunes
$direccion_nro = '7';

$row = 0;

$error = 0;

$lote_igual = 0;

// Bucle para lectura del archivo e insercion en base de datos

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		$row++; 

		$fecha_envio_egg = $data[1];
		$expte_ivba_num = $data[2];
		$expte_ivba_alc = $data[3];
		$persona_apellido = $data[4];
		$persona_nombre = $data[5];
		$persona_doc_tipo = 1;
		$persona_dni_nro = $data[6];
		$persona_domicilio = $data[7];
		$lote_circ = $data[10];
		$lote_secc = $data[11];
		$lote_fr = $data[10];
		$lote_qta = $data[11];
		$lote_ch = $data[12];
		$lote_manzana = $data[13];
		$lote_parcela = $data[14];
		$lote_uf = $data[15];
		$domic_torre = [16];
		$domic_monoblock = $data[17];
		$domic_escalera = $data[18];
		$domic_piso = $data[19];
		$domic_depto = $data[20];
		$domic_casa_num = $data[21];
		$lote_partido = $data[22];
		$lote_res_adj = $data[23];
		
/*
		$lote_partido = $data[0];
		$escritura_rnrd = $data[1];
		$escritura_escribano_carnet = $data[2];
		$escritura_norma_tipo = $data[3];
		$escritura_decreto = $data[5];
		$escritura_anio = $data[6];
		$escritura_numero = $data[7];
		$escritura_expte = $data[8];
		$escritura_expte_anio = $data[9];
		$lote_circ = $data[10];
		$lote_secc = $data[11];
		$lote_manzana = $data[12];
		$lote_parcela = $data[13];
		$lote_subparcela = $data[14];
		$persona_nombre_completo = $data[15];
		$persona_doc_tipo = $data[16];
		$persona_dni_nro = $data[17];
		$escritura_fecha = $data[18];
		$escritura_acta = $data[19];
		$escritura_inscripta = $data[20];
*/
		
		$envioegg_fecha_mysql = cambiaf_a_mysql($fecha_envio_egg);



//--> Busco si existe la persona en la base de datos

	$sql_persona = "SELECT
	Persona_dni_nro FROM dbo_persona WHERE Persona_dni_nro = '$persona_dni_nro'";
	
	@$resPersona = mysql_query ($sql_persona,$link);
	@$rsPersona = mysql_fetch_array ($resPersona);
	@$cantpersona = mysql_num_rows($resPersona);

	if ($cantpersona < 1) {

//--> Final de este proceso en la linea 225


//--> Busco si existe el lote en la base de datos

	$sql = "SELECT 
	Lote_nro,
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela
	
	FROM $dbo_tabla_lote WHERE
	
	Partido_nro='$lote_partido' AND
	Lote_circunscripcion='$lote_circ' AND
	Lote_seccion='$lote_secc' AND
	Lote_manzana='$lote_manzana' AND
	Lote_parcela='$lote_parcela' AND
	Lote_subparcela='$lote_subparcela'";
	
	@$resLote = mysql_query ($sql,$link);
	@$rsLote = mysql_fetch_array ($resLote);
	@$cant = mysql_num_rows($resLote);

	//Verifico si existe un lote con la nomenclatura ingresada

	if ($cant > 0) {
	
	$Lote_nro=$rsLote["Lote_nro"];
	echo "Lote existente - ";
	++$lote_igual;

	} else {

	// Si no existe, inserto el lote en la tabla		
		
	$insLote = "INSERT INTO $dbo_tabla_lote (
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela,
	Lote_idmigra
	) VALUES (
	'$lote_partido',
	'$lote_circ',
	'$lote_secc',
	'$lote_manzana',
	'$lote_parcela',
	'$lote_subparcela',
	'$id_migra')";
	
	

	if (mysql_query($insLote,$link)) {
			$Lote_nro = mysql_insert_id();			
		}else{
			echo "<b>Error en insercion de lote</b><br>";
		}
	} //Fin del "if" de alta de lote
		
	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Direccion_nro,
	Familia_apellido,
	Partido_nro,
	Lote_nro,
	insert_fecha,
	insert_usuario,
	insert_tipo,
	Familia_idmigra
	)VALUES(
	'3',
	'$persona_nombre_completo',
	'$lote_partido',
	'$Lote_nro',
	CURRENT_DATE,
	'3',
	'2',
	'$id_migra')";	
		
	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	}else{
	echo "No se pudo realizar la insercion de familia ($persona_nombre_completo)";
	$error++;
	}	

//--> Inserto la Escritura

	$insEsc = "INSERT INTO $dbo_tabla_escritura (
	Escritura_numero,
	Escritura_fecha,
	Escritura_anio,
	Escritura_acta,
	Escritura_inscripta,
	Escritura_escribano_carnet,
	Escritura_rnrd,
	Escritura_expte,
	Escritura_decreto,
	Escritura_expte_anio,
	Familia_nro,
	Escritura_idmigra
	) VALUES (
	'$escritura_numero',
	'$escritura_fecha_mysql',
	'$escritura_anio',
	'$escritura_acta',
	'$escritura_inscripta',
	'$escritura_escribano_carnet',
	'$escritura_rnrd',
	'$escritura_expte',
	'$escritura_decreto',
	'$escritura_expte_anio',
	'$Familia_nro',
	'$id_migra')";

	if (@mysql_query($insEsc,$link)) {
	$id_Escritura = mysql_insert_id();
	}else{
	echo "No se pudo realizar la insercion de Escritura";}

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_nombre_completo,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro, 
	Categoria_nro,
	Familia_nro,
	Persona_idmigra
	)VALUES(
	'$persona_nombre_completo',
	'$persona_doc_tipo',
	'$persona_dni_nro',
	'10',
	'1',
	'$Familia_nro',
	'$id_migra')";
	
	mysql_query($inst1,$link);

		echo "$row - Migración exitosa! <br>";
		//echo "$row - Partido: $Lote_partido | Persona: $Persona_nombre_completo ($Persona_dni_nro)";
		
		}else{ echo "<h2>La persona ya se encuentra incorporada (".$persona_dni_nro.")</h2>";} 

	}  //Este es el fin del while

echo "<h2>Proceso finalizado</h2>";

echo "<p>Se han incorporado $row registros a la base de datos</p>";

fclose ($fp); 

//Sumador de registros

$archivo = "contador.txt";
$contador = 0;

$fpcont = fopen($archivo,"r");
$contador = fgets($fpcont, 26);
fclose($fpcont);

$contador = $contador + $row;

$fpcont = fopen($archivo,"w+");
fwrite($fpcont, $contador, 26);
fclose($fpcont);


echo "<p>Se han encontrado $lote_igual lotes coincidentes</p>";
echo "<p>Se han procesado un total de $contador registros</p>"; 
echo "<p>Archivo procesado: $id_migra</p>";

$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$tiempofinal = $mtime;
$tiempototal = ($tiempofinal - $tiempoinicial);
$tiempototalmin = $tiempototal/60;
echo "<p>La página fue creada en ".$tiempototal." segundos (".$tiempototalmin." minutos)</p>"; 
?>
</body>
</html>	