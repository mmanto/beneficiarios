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
$direccion = $user["Direccion_nro"];

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


$adjudicacion_pendiente = $_POST["adjudicacion_pendiente"];

$familia_ocupacion_verificar = $_POST["familia_ocupacion_verificar"];

$familia_domic = $_POST["domicilio"];


if ($_POST["doc_completa"]!='1') {$familia_doc_completa = '0';} else {$familia_doc_completa = '1';};

if ($_POST["pagocancelado"]!='1') {$familia_pagocancelado = '0';} else {$familia_pagocancelado = '1';};

//if ($_POST["pendiente"]!='1') {$familia_tramite_pendiente = '0';} else {$familia_tramite_pendiente = '1';};

if ($_POST["procrear"]!='1') {$familia_procrear = '0';} else {$familia_procrear = '1';};

if ($_POST["condescrit"]!='1') {$familia_condescrit = '0';} else {$familia_condescrit = '1';};

//Boleto
if (!$_POST["blnBoleto"]) {$blnBoleto = '0';} else {$blnBoleto = $_POST["blnBoleto"];};

if (!$_POST["boleto_fecha"] || $_POST["boleto_fecha"]=='-') {$boleto_fecha = '0';} else {$boleto_fecha = $_POST["boleto_fecha"];};


$familia_montoadj = $_POST["familia_montoadj"];

$familia_montoadj_cuotas = $_POST["familia_montoadj_cuotas"];

$familia_observaciones = $_POST["observaciones"];


//Plano

if (!$_POST["plano_numero"] || $_POST["plano_numero"]=='-') {$plano_numero = '0';} else {$plano_numero = $_POST["plano_numero"];};
$plano_aprobado_fecha = cambiaf_a_mysql($_POST["plano_aprobado_fecha"]);

//Plan vivienda
$planvivienda = $_POST["planvivienda"];


$sqlBo = mysql_query("SELECT Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio");
$barrio = mysql_fetch_array($sqlBo);
$partido = $barrio["Partido_nro"];


//Definicion de variables de persona 1

$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_ecivil = $_POST["t1_ecivil"];
if($_POST["t1_sep_hecho"] == '1') { $t1_sep_hecho = '1'; }else{ $t1_sep_hecho = '0'; }
$t1_sep_hecho = $_POST["t1_sep_hecho"];
$t1_nacionalidad = $_POST["t1_nacionalidad"];

if ($_POST["t1_fecha_nac"] == 'dd/mm/aaaa') { $t1_fecha_nac = "00-00-0000"; }else{$t1_fecha_nac = $_POST["t1_fecha_nac"];}

$t1_lugar_nac = $_POST["t1_lugar_nac"];
$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];
//$t1_padre_apellido = $_POST["t1_padre_apellido"];
//$t1_padre_nombre = $_POST["t1_padre_nombre"];
$t1_padre_nmbcompleto = $_POST["t1_padre_nmbcompleto"];
$t1_madre_nmbcompleto = $_POST["t1_madre_nmbcompleto"];

$t1_madre_apellido = $_POST["t1_madre_apellido"];
$t1_madre_nombre = $_POST["t1_madre_nombre"];
$t1_telefono = $_POST["t1_telefono"];
////
if( $_POST["t1_baja_persona"] == '1') {$t1_baja = "1"; }else{ $t1_baja = "0"; }
$t1_baja_resolucion = $_POST["t1_baja_resolucion"];
$t1_baja_res_alta = $_POST["t1_baja_res_alta"];
$t1_baja_obs = $_POST["t1_baja_obs"];

//Definicion de variables de persona 2
$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];
if (!$_POST["t2_doc_nro"] || $_POST["t2_doc_nro"]=='-') {$t2_doc_nro = '0';}else{$t2_doc_nro = $_POST["t2_doc_nro"];}
$t2_ecivil = $_POST["t2_ecivil"];
if($_POST["t2_sep_hecho"] == '1') { $t2_sep_hecho = '1'; }else{ $t2_sep_hecho = '0'; }
$t2_nacionalidad = $_POST["t2_nacionalidad"];
if ($_POST["t2_fecha_nac"] == 'dd/mm/aaaa') { $t2_fecha_nac = "00-00-0000"; }else{$t2_fecha_nac = $_POST["t2_fecha_nac"];}
$t2_lugar_nac = $_POST["t2_lugar_nac"];
$t2_conyuge_apellido = $_POST["t2_conyuge_apellido"];
$t2_conyuge_nombre = $_POST["t2_conyuge_nombre"];

$t2_padre_nmbcompleto = $_POST["t2_padre_nmbcompleto"];
$t2_madre_nmbcompleto = $_POST["t2_madre_nmbcompleto"];

$t2_telefono = $_POST["t2_telefono"];
////
if( $_POST["t2_baja_persona"] == '1') {$t2_baja = "1"; }else{ $t2_baja = "0"; }
$t2_baja_resolucion = $_POST["t2_baja_resolucion"];
$t2_baja_res_alta = $_POST["t2_baja_res_alta"];
$t2_baja_obs = $_POST["t2_baja_obs"];


//Definicion de variables de persona 3
$t3_apellido = $_POST["t3_apellido"];
$t3_nombre = $_POST["t3_nombre"];
$t3_doc_tipo = $_POST["t3_doc_tipo"];
if (!$_POST["t3_doc_nro"] || $_POST["t3_doc_nro"]=='-') {$t3_doc_nro = '0';}else{$t3_doc_nro = $_POST["t3_doc_nro"];}
$t3_ecivil = $_POST["t3_ecivil"];
if($_POST["t3_sep_hecho"] == '1') { $t3_sep_hecho = '1'; }else{ $t3_sep_hecho = '0'; }
$t3_nacionalidad = $_POST["t3_nacionalidad"];
if ($_POST["t3_fecha_nac"] == 'dd/mm/aaaa') { $t3_fecha_nac = "00-00-0000"; }else{$t3_fecha_nac = $_POST["t3_fecha_nac"];}
$t3_lugar_nac = $_POST["t3_lugar_nac"];
$t3_conyuge_apellido = $_POST["t3_conyuge_apellido"];
$t3_conyuge_nombre = $_POST["t3_conyuge_nombre"];

$t3_padre_nmbcompleto = $_POST["t3_padre_nmbcompleto"];
$t3_madre_nmbcompleto = $_POST["t3_madre_nmbcompleto"];

$t3_telefono = $_POST["t3_telefono"];
////
if( $_POST["t3_baja_persona"] == '1') {$t3_baja = "1"; }else{ $t3_baja = "0"; }
$t3_baja_resolucion = $_POST["t3_baja_resolucion"];
$t3_baja_res_alta = $_POST["t3_baja_res_alta"];
$t3_baja_obs = $_POST["t3_baja_obs"];


//Definicion de variables de persona 4
$t4_apellido = $_POST["t4_apellido"];
$t4_nombre = $_POST["t4_nombre"];
$t4_doc_tipo = $_POST["t4_doc_tipo"];
if (!$_POST["t4_doc_nro"] || $_POST["t4_doc_nro"]=='-') {$t4_doc_nro = '0';}else{$t4_doc_nro = $_POST["t4_doc_nro"];}
$t4_ecivil = $_POST["t4_ecivil"];
if($_POST["t4_sep_hecho"] == '1') { $t4_sep_hecho = '1'; }else{ $t4_sep_hecho = '0'; }
$t4_nacionalidad = $_POST["t4_nacionalidad"];
if ($_POST["t4_fecha_nac"] == 'dd/mm/aaaa') { $t4_fecha_nac = "00-00-0000"; }else{$t4_fecha_nac = $_POST["t4_fecha_nac"];}
$t4_lugar_nac = $_POST["t4_lugar_nac"];
$t4_conyuge_apellido = $_POST["t4_conyuge_apellido"];
$t4_conyuge_nombre = $_POST["t4_conyuge_nombre"];
$t4_padre_nmbcompleto = $_POST["t4_padre_nmbcompleto"];
$t4_madre_nmbcompleto = $_POST["t4_madre_nmbcompleto"];
$t4_telefono = $_POST["t4_telefono"];
////////
if( $_POST["t4_baja_persona"] == '1') {$t4_baja = "1"; }else{ $t4_baja = "0"; }
$t4_baja_resolucion = $_POST["t4_baja_resolucion"];
$t4_baja_res_alta = $_POST["t4_baja_res_alta"];
$t4_baja_obs = $_POST["t4_baja_obs"];



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
	Plano_num,
	Plano_aprobado_fecha,
	Plano_aprobado,
	Plano_registrado,
	Planvivienda_nro,
	Barrio_nro,
	Adjudicacion_pendiente,
	Familia_ocupacion_verificar,
	Familia_domic,
	Direccion_nro,
	Expte_esc_nro,
	Familia_res_adj,
	Familia_matricula,
	Familia_montoadj,
	Familia_montoadj_cuotas,
	Familia_doc_completa,
	Familia_pagocancelado,
	Familia_cond_escrit,
	Familia_observaciones,
	Familia_beneficio_origen,
	blnBoleto,
	Boleto_fecha,
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
	'$plano_numero',
	'$plano_aprobado_fecha',
	'$plano_aprobado',
	'$plano_registrado',
	'$planvivienda',
	'$idBarrio',
	'$adjudicacion_pendiente',
	'$familia_ocupacion_verificar',
	'$familia_domic',
	'$direccion',
	'$expte_esc_nro',
	'$familia_resolucion',
	'$familia_matricula',
	'$familia_montoadj',
	'$familia_montoadj_cuotas',
	'$familia_doc_completa',
	'$familia_pagocancelado',
	'$familia_condescrit',
	'$familia_observaciones',
	'$beneficio_origen',
	'$blnBoleto',
	'$boleto_fecha',
	'$familia_procrear',
	CURRENT_DATE,
	'$log_usuario')";

	if (mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	
	$abcd = mysql_query("UPDATE dbo_familia SET Barrio_nro = '$idBarrio' WHERE Familia_nro = $Familia_nro");

// Insert en tabla dbo_lote s?lo a los fines de Backup

$insLote = "INSERT INTO dbo_lote (
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

	$inst1 = "INSERT INTO dbo_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Ecivil_sep_hecho,
	Persona_lugar_nac,
	Persona_fecha_nac,
	Persona_nacionalidad,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Persona_telefono,
	Persona_baja,
	Persona_baja_resolucion,
	Persona_baja_res_alta,
	Persona_baja_obs,
	Persona_baja_usuario,
	Familia_nro
	)VALUES(
	'$t1_apellido',
	'$t1_nombre',
	'$t1_doc_tipo',
	'$t1_doc_nro',
	'$t1_ecivil',
	'$t1_sep_hecho',
	'$t1_lugar_nac',
	'$t1_fecha_nac',
	'$t1_nacionalidad',
	'$t1_conyuge_apellido',
	'$t1_conyuge_nombre',
	'$t1_padre_nmbcompleto',
	'$t1_madre_nmbcompleto',
	'$t1_telefono',
	'$t1_baja',
	'$t1_baja_resolucion',
	'$t1_baja_res_alta',
	'$t1_baja_obs',
	'$log_usuario',
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
	Ecivil_sep_hecho,
	Persona_lugar_nac,
	Persona_fecha_nac,
	Persona_nacionalidad,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Persona_telefono,
	Persona_baja,
	Persona_baja_resolucion,
	Persona_baja_res_alta,
	Persona_baja_obs,
	Persona_baja_usuario,
	Familia_nro
	)VALUES(
	'$t2_apellido',
	'$t2_nombre',
	'$t2_doc_tipo',
	'$t2_doc_nro',
	'$t2_ecivil',
	'$t2_sep_hecho',
	'$t2_lugar_nac',
	'$t2_fecha_nac',
	'$t2_nacionalidad',
	'$t2_conyuge_apellido',
	'$t2_conyuge_nombre',
	'$t2_padre_nmbcompleto',
	'$t2_madre_nmbcompleto',
	'$t2_telefono',
	'$t2_baja',
	'$t2_baja_resolucion',
	'$t2_baja_res_alta',
	'$t2_baja_obs',
	'$log_usuario',
	'$Familia_nro')";
	
	mysql_query($inst2,$link);
			
	}
	
// Insert de titular 3, solo si existe un titular 3
// Para ello, compruebo que el campo $t3_doc_nro sea distinto de 0:

if ($t3_doc_nro!='0') {

	$inst3 = "INSERT INTO dbo_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Ecivil_sep_hecho,
	Persona_lugar_nac,
	Persona_fecha_nac,
	Persona_nacionalidad,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Persona_telefono,
	Persona_baja,
	Persona_baja_resolucion,
	Persona_baja_res_alta,
	Persona_baja_obs,
	Persona_baja_usuario,
	Familia_nro
	)VALUES(
	'$t3_apellido',
	'$t3_nombre',
	'$t3_doc_tipo',
	'$t3_doc_nro',
	'$t3_ecivil',
	'$t3_sep_hecho',
	'$t3_lugar_nac',
	'$t3_fecha_nac',
	'$t3_nacionalidad',
	'$t3_conyuge_apellido',
	'$t3_conyuge_nombre',
	'$t3_padre_nmbcompleto',
	'$t3_madre_nmbcompleto',
	'$t3_telefono',
	'$t3_baja',
	'$t3_baja_resolucion',
	'$t3_baja_res_alta',
	'$t3_baja_obs',
	'$log_usuario',
	'$Familia_nro')";
	
	mysql_query($inst3,$link);
			
	}	
	
// Insert de titular 4, solo si existe un titular 4
// Para ello, compruebo que el campo $t4_doc_nro sea distinto de 0:

if ($t4_doc_nro!='0') {

	$inst4 = "INSERT INTO dbo_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Ecivil_sep_hecho,
	Persona_lugar_nac,
	Persona_fecha_nac,
	Persona_nacionalidad,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Persona_telefono,
	Persona_baja,
	Persona_baja_resolucion,
	Persona_baja_res_alta,
	Persona_baja_obs,
	Persona_baja_usuario,
	Familia_nro
	)VALUES(
	'$t4_apellido',
	'$t4_nombre',
	'$t4_doc_tipo',
	'$t4_doc_nro',
	'$t4_ecivil',
	'$t4_sep_hecho',
	'$t4_lugar_nac',
	'$t4_fecha_nac',
	'$t4_nacionalidad',
	'$t4_conyuge_apellido',
	'$t4_conyuge_nombre',
	'$t4_padre_nmbcompleto',
	'$t4_madre_nmbcompleto',
	'$t4_telefono',
	'$t4_baja',
	'$t4_baja_resolucion',
	'$t4_baja_res_alta',
	'$t4_baja_obs',
	'$log_usuario',
	'$Familia_nro')";
	
	mysql_query($inst4,$link);
			
	}	
?>
				
<h2>Beneficiario cargado correctamente </h2>
<p>&nbsp;</p> 
<p><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<? echo $Familia_nro; ?>')>Ver informe del beneficio cargado</a></p>
<p><a href="titular_alta_individual_form.php?idFamilia=<? echo $Familia_nro; ?>">Cargar otro titular para este mismo lote</a></p>
<p><a href="beneficio_alta_porbarrio_multiple_form.php?idBarrio=<? echo $idBarrio; ?>">Cargar otro beneficio en el mismo barrio</a></p>
<p><a href="barrios_listar_partido.php?idPartido=<? echo $partido; ?>">Volver al listado de barrios</a></p>
<p><a href="menu.php">Volver al menu</a></p>

<?

}else{ ?>

<h2>No se puedo realizar la insercion de familia</h2>
<h1>Por favor contactese con el administrador</h1>
<p><?=$idBarrio ?></p>
<p><a href="menu.php">Volver al menu</a></p>

<?

} } } ?>
