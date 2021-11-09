<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];


//////////////////////////////////////////////

// Definición nombres de tablas

     $dbo_tabla_lote = "dbo_lote";
	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";
	 //$dbo_tabla_escritura = "dbo_escritura";

//////////////////////////////////////////////

$partido = $_POST["idPartido"];
if (!$_POST["lote_localidad"]) {$lote_localidad ='0';} else {$lote_localidad = $_POST["lote_localidad"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-') {$lote_manzana = '0';} else {$lote_manzana = $_POST["lote_manzana"];};
if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-') {$lote_parcela = '0';} else {$lote_parcela = $_POST["lote_parcela"];};
if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};
$lote_barrio = $_POST["barrio"];


//Definicion de variables de persona 1
$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];


//Definicion de variables de persona 2

$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];
if (!$_POST["t2_doc_nro"]) {$t2_doc_nro = '0'; }else{ $t2_doc_nro = $_POST["t2_doc_nro"];};

//Definicion de variables de persona 3

$t3_apellido = $_POST["t3_apellido"];
$t3_nombre = $_POST["t3_nombre"];
$t3_doc_tipo = $_POST["t3_doc_tipo"];
if (!$_POST["t3_doc_nro"]) {$t3_doc_nro = '0'; }else{ $t3_doc_nro = $_POST["t3_doc_nro"];};

if (!$_POST["resolucion"] || $_POST["resolucion"]=='-') {$familia_resolucion = '0';} else {$familia_resolucion = $_POST["resolucion"];};

if (!$_POST["reqcompleto"]) {$reqcompleto = '0';} else {$reqcompleto = $_POST["reqcompleto"];};


//

	$ins = "INSERT INTO $dbo_tabla_lote (
	$partido,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela,
	Lote_barrio
	) VALUES (
	'$idPartido',
	'$lote_circ',
	'$lote_secc',
	'$lote_ch',
	'$lote_qta',
	'$lote_fracc',
	'$lote_manzana',
	'$lote_parcela',
	'$lote_subpc',
	'$lote_barrio')";

	if (mysql_query($ins)) {
			$Lote_nro = mysql_insert_id();			
		}else{
			echo "<b>Error en insercion de lote</b><br>";
		}


// Insert de familia con los datos ingresados:

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Familia_apellido,
	Partido_nro,
	Lote_nro,
	Direccion_nro,
	Expte_esc_nro,
	Familia_res_adj,
	Familia_reqcompleto,
	insert_fecha,
	insert_usuario
	)VALUES(
	'$t1_apellido',
	'$partido',
	'$Lote_nro',
	'$direccion',
	'$expte_nro',
	'$familia_resolucion',
	'$reqcompleto', 
	CURRENT_DATE,
	'$log_usuario')";

	if (@mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	}else{
	echo "No se puedo realizar la insercion de familia";}



// Insert de titular 1

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Categoria_nro,
	Familia_nro
	)VALUES(
	'$t1_apellido',
	'$t1_nombre',
	'$t1_doc_tipo',
	'$t1_doc_nro',
	'1',
	'$Familia_nro')";
	
	mysql_query($inst1,$link);


// Insert de titular 2, solo si existe un titular 2
// Para ello, compruebo que el campo $t2_doc_nro sea distinto de 0:

if ($t2_doc_nro!='0') {

	$inst2 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Categoria_nro,
	Familia_nro
	)VALUES(
	'$t2_apellido',
	'$t2_nombre',
	'$t2_doc_tipo',
	'$t2_doc_nro',
	'2',
	'$Familia_nro')";
	
		mysql_query($inst2,$link);
			
				} else {}

// Insert de titular 3, solo si existe un titular 3
// Para ello, compruebo que el campo $t3_doc_nro sea distinto de 0:

if ($t3_doc_nro!='0') {

	$inst3 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Categoria_nro,
	Familia_nro
	)VALUES(
	'$t3_apellido',
	'$t3_nombre',
	'$t3_doc_tipo',
	'$t3_doc_nro',
	'2',
	'$Familia_nro')";
	
		mysql_query($inst3,$link); } else {}
?>


			
<h2>Beneficiario cargado correctamente</h2> 
<p><a href="beneficio_alta_form.php">Cargar otro beneficio</a></p>
<p><a href="menu.php">Volver al menu</p>

<? } ?>