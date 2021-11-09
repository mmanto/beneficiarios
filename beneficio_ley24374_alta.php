<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{
	
if($_POST["idPartido"] == '0') {

include ("cabecera.php");
		
?>

<h1>Debe seleccionar un partido</h1>
<p><a href="javascript:history.back()">Volver</a>

<? }else{ 

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];

//Definicion de tablas

$tabla_familia = "dbo_familia";
$tabla_lote = "dbo_lote";
$tabla_persona = "dbo_persona";

//Definicion de variables

$idPartido = $_POST["idPartido"];

$beneficio_origen = '3';

$escribano_registro = $_POST["escribano_registro"];

$escribano_nombre = $_POST["escribano_nombre"];

$expte_ley_reg_num = $_POST["expte_ley_reg_num"];

$expte_ley_cons_num = $_POST["expte_ley_cons_num"];

$partida = $_POST["partida"];

$escritura_numero = $_POST["escritura_numero"];

$escritura_fecha1 = $_POST["escritura_fecha"];

$escritura_fecha = cambiaf_a_mysql($escritura_fecha1);


$escritura_insc_fecha1 = $_POST["escritura_insc_fecha"];

$escritura_insc_fecha = cambiaf_a_mysql($escritura_insc_fecha1);

$alta_instancia = $_POST["alta_instancia"];

if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_secc"] || $_POST["lote_secc"]=='-') {$lote_secc = '0';} else {$lote_secc = $_POST["lote_secc"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-') {$lote_manzana = '0';} else {
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-') {$lote_manzana = '0';} else {
$Lote_manzana = $_POST["lote_manzana"];
$Lote_mz_limp_01 = ereg_replace("[^0-9]", "", $Lote_manzana);
$Lote_mz_limp_02 = ereg_replace("[^A-Za-z]", "", $Lote_manzana);
$Lote_mz_limp_02 = strtolower($Lote_mz_limp_02 );
$lote_manzana_limp = $Lote_mz_limp_01.$Lote_mz_limp_02;
};

if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-') {$lote_parcela = '0';} else {
$Lote_parcela = $_POST["lote_parcela"];
$Lote_pc_limp_01 = ereg_replace("[^0-9]", "", $Lote_parcela);
$Lote_pc_limp_02 = ereg_replace("[^A-Za-z]", "", $Lote_parcela);
$Lote_pc_limp_02 = strtolower($Lote_pc_limp_02 );
$lote_parcela_limp = $Lote_pc_limp_01.$Lote_pc_limp_02;
};

if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};

$familia_observaciones = $_POST["observaciones"];

//Definicion de variables de persona 1

$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_ecivil = '10';


//Definicion de variables de persona 2
$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];
if (!$_POST["t2_doc_nro"] || $_POST["t2_doc_nro"]=='-') {$t2_doc_nro = '0';}else{$t2_doc_nro = $_POST["t2_doc_nro"];}
$t2_ecivil = '10';



// Insert de familia con los datos ingresados:

	$insFlia = "INSERT INTO $tabla_familia (
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela,
	Familia_beneficio_origen,
	Expte_ley_registro,
	Expte_ley_escribano_nombre,
	Expte_ley_alta_instancia,
	Expte_ley_reg_num,
	Expte_ley_cons_num,
	Lote_partida,
	Familia_escritura,
	Familia_escritura_fecha,	
	Familia_escritura_insc_fecha,	
	insert_fecha,
	insert_usuario
	)VALUES(
	'$idPartido',
	'$lote_circ',
	'$lote_secc',
	'$lote_ch',
	'$lote_qta',
	'$lote_fracc',
	'$lote_manzana_limp',
	'$lote_parcela_limp',
	'$lote_subpc',
	'$beneficio_origen',
	'$escribano_registro',
	'$escribano_nombre',
	'$alta_instancia',
	'$expte_ley_reg_num',
	'$expte_ley_cons_num',
	'$partida',
	'$escritura_numero',
	'$escritura_fecha',
	'$escritura_insc_fecha',	
	CURRENT_DATE,
	'$log_usuario')";

	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	

// Insert en tabla dbo_lote sólo a los fines de Backup

$insLote = "INSERT INTO $tabla_lote (
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela,
	Familia_nro
	)VALUES(
	'$partido',
	'$lote_circ',
	'$lote_secc',
	'$lote_ch',
	'$lote_qta',
	'$lote_fracc',
	'$lote_manzana_limp',
	'$lote_parcela_limp',
	'$lote_subpc',
	'$Familia_nro')";

	mysql_query($insLote,$link);

// Insert de titular 1

	$inst1 = "INSERT INTO $tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Familia_nro,
	Persona_alta_usuario,
	Persona_alta_fecha	
	)VALUES(
	'$t1_apellido',
	'$t1_nombre',
	'$t1_doc_tipo',
	'$t1_doc_nro',
	'$t1_ecivil',
	'$Familia_nro',
	CURRENT_DATE,
	'$log_usuario')";
	
	mysql_query($inst1,$link);


// Insert de titular 2, solo si existe un titular 2
// Para ello, compruebo que el campo $t2_doc_nro sea distinto de 0:

if ($t2_doc_nro!='0') {

	$inst2 = "INSERT INTO $tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Familia_nro,
	Persona_alta_usuario,
	Persona_alta_fecha	
	)VALUES(
	'$t2_apellido',
	'$t2_nombre',
	'$t2_doc_tipo',
	'$t2_doc_nro',
	'$t2_ecivil',
	'$Familia_nro',
	CURRENT_DATE,
	'$log_usuario'
	)";
	
		mysql_query($inst2,$link);
			
	} 	
	
	 ?>
				
<h2>Beneficiario cargado correctamente | <? echo $escritura_insc_fecha; ?></h2> 
<p><a href="beneficio_ley24374_alta_form.php">Cargar otro beneficiario para este mismo barrio</a></p>
<p><a href="sbt-menu.php">Volver al menu</p>

<?

}else{ ?>

<h2>No se puedo realizar la insercion de familia</h2>
<h1>Por favor contactese con el administrador</h1>
<p><a href="sbt-menu.php">Volver al menu</p>

<?

} } } }?>
