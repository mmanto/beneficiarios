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

//Definicion de variables

$idBarrio = $_POST["idBarrio"];

$beneficio_origen = $_POST["beneficio_origen"];

$expte_esc_nro = $_POST["expte_esc_nro"];


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

if (!$_POST["resolucion"] || $_POST["resolucion"]=='-') {$familia_resolucion = '0';} else {$familia_resolucion = $_POST["resolucion"];};

if (!$_POST["matricula"] || $_POST["matricula"]=='-') {$familia_matricula = '0';} else {$familia_matricula = $_POST["matricula"];};


$lote_domic = $_POST["domicilio"];

$familia_telefono = $_POST["familia_telefono"];

if ($_POST["doc_completa"]!='1') {$familia_doc_completa = '0';} else {$familia_doc_completa = '1';};

if ($_POST["pagocancelado"]!='1') {$familia_pagocancelado = '0';} else {$familia_pagocancelado = '1';};

if ($_POST["pendiente"]!='1') {$familia_tramite_pendiente = '0';} else {$familia_tramite_pendiente = '1';};

if ($_POST["procrear"]!='1') {$familia_procrear = '0';} else {$familia_procrear = '1';};

$familia_observaciones = $_POST["observaciones"];

$sqlBo = mysql_query("SELECT Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio");
$barrio = mysql_fetch_array($sqlBo);
$partido = $barrio["Partido_nro"];

//Definicion de variables de persona 1

$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_ecivil = $_POST["t1_ecivil"];
$t1_nacionalidad = $_POST["t1_nacionalidad"];

if ($_POST["t1_fecha_nac"] == 'dd/mm/aaaa') { $t1_fecha_nac = "00-00-0000"; }else{$t1_fecha_nac = $_POST["t1_fecha_nac"];}

$t1_lugar_nac = $_POST["t1_lugar_nac"];
$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];
$t1_padre_apellido = $_POST["t1_padre_apellido"];
$t1_padre_nombre = $_POST["t1_padre_nombre"];
$t1_madre_apellido = $_POST["t1_madre_apellido"];
$t1_madre_nombre = $_POST["t1_madre_nombre"];

//Definicion de variables de persona 2
$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];
if (!$_POST["t2_doc_nro"] || $_POST["t2_doc_nro"]=='-') {$t2_doc_nro = '0';}else{$t2_doc_nro = $_POST["t2_doc_nro"];}
$t2_ecivil = $_POST["t2_ecivil"];
$t2_nacionalidad = $_POST["t2_nacionalidad"];
if ($_POST["t2_fecha_nac"] == 'dd/mm/aaaa') { $t2_fecha_nac = "00-00-0000"; }else{$t2_fecha_nac = $_POST["t2_fecha_nac"];}
$t2_lugar_nac = $_POST["t2_lugar_nac"];
$t2_conyuge_apellido = $_POST["t2_conyuge_apellido"];
$t2_conyuge_nombre = $_POST["t2_conyuge_nombre"];
$t2_padre_apellido = $_POST["t2_padre_apellido"];
$t2_padre_nombre = $_POST["t2_padre_nombre"];
$t2_madre_apellido = $_POST["t2_madre_apellido"];
$t2_madre_nombre = $_POST["t2_madre_nombre"];


// Insert de familia con los datos ingresados:

	$insFlia = "INSERT INTO dbo_familia (
	Familia_apellido,
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela,
	Barrio_nro,
	Lote_domic,
	Direccion_nro,
	Expte_esc_nro,
	Familia_res_adj,
	Familia_matricula,
	Familia_telefono,
	Familia_doc_completa,
	Familia_pagocancelado,
	Familia_tramitependiente,
	Familia_observaciones,
	Familia_beneficio_origen,
	blnProcrear,
	insert_fecha,
	insert_usuario
	)VALUES(
	'$t1_apellido',
	'$partido',
	'$lote_circ',
	'$lote_secc',
	'$lote_ch',
	'$lote_qta',
	'$lote_fracc',
	'$lote_manzana_limp',
	'$lote_parcela_limp',
	'$lote_subpc',
	'$idBarrio',
	'$lote_domic',
	'$direccion',
	'$expte_esc_nro',
	'$familia_resolucion',
	'$familia_matricula',
	'$familia_telefono',
	'$familia_doc_completa',
	'$familia_pagocancelado',
	'$familia_tramite_pendiente',
	'$familia_observaciones',
	'$beneficio_origen',
	'$familia_procrear',
	CURRENT_DATE,
	'$log_usuario')";

	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	
	$abcd = mysql_query("UPDATE dbo_familia SET Barrio_nro = '$idBarrio' WHERE Familia_nro = $Familia_nro");
	
	
// Insert de titular 1

	$inst1 = "INSERT INTO dbo_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Persona_lugar_nac,
	Persona_fecha_nac,
	Persona_nacionalidad,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_apellido,
	Persona_padre_nombre,
	Persona_madre_apellido,
	Persona_madre_nombre,
	Familia_nro
	)VALUES(
	'$t1_apellido',
	'$t1_nombre',
	'$t1_doc_tipo',
	'$t1_doc_nro',
	'$t1_ecivil',
	'$t1_lugar_nac',
	'$t1_fecha_nac',
	'$t1_nacionalidad',
	'$t1_conyuge_apellido',
	'$t1_conyuge_nombre',
	'$t1_padre_apellido',
	'$t1_padre_nombre',
	'$t1_madre_apellido',
	'$t1_madre_nombre',
	'$Familia_nro')";
	
	mysql_query($inst1,$link);


// Insert de titular 2, solo si existe un titular 2
// Para ello, compruebo que el campo $t2_doc_nro sea distinto de 0:

if ($t2_doc_nro!='0') {

	$inst2 = "INSERT INTO dbo_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Persona_lugar_nac,
	Persona_fecha_nac,
	Persona_nacionalidad,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_apellido,
	Persona_padre_nombre,
	Persona_madre_apellido,
	Persona_madre_nombre,
	Familia_nro
	)VALUES(
	'$t2_apellido',
	'$t2_nombre',
	'$t2_doc_tipo',
	'$t2_doc_nro',
	'$t2_ecivil',
	'$t2_lugar_nac',
	'$t2_fecha_nac',
	'$t2_nacionalidad',
	'$t2_conyuge_apellido',
	'$t2_conyuge_nombre',
	'$t2_padre_apellido',
	'$t2_padre_nombre',
	'$t2_madre_apellido',
	'$t2_madre_nombre',
	'$Familia_nro')";
	
		mysql_query($inst2,$link);
			
	} ?>
				
<h2>Beneficiario cargado correctamente | <? echo $expte_esc_nro; ?></h2> 
<p><a href="beneficio_alta_porbarrio_form.php?idBarrio=<? echo $idBarrio; ?>">Cargar otro beneficiario para este mismo barrio</a></p>
<p><a href="barrios_listar_benef.php">Volver al listado de barrios</p>
<p><a href="menu.php">Volver al menu</p>

<?

}else{ ?>

<h2>No se puedo realizar la insercion de familia</h2>
<h1>Por favor contactese con el administrador</h1>
<p><?=$idBarrio ?></p>
<p><a href="menu.php">Volver al menu</p>

<?

} } } ?>
