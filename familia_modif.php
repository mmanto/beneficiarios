<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];

$idFamilia = $_POST["idFamilia"];
$origen = $_POST["origen"];

//Definicion de variables 

$resolucion = $_POST["resolucion"];
$blnBoleto = $_POST["blnBoleto"];
$boleto_fecha = $_POST["boleto_fecha"];
$doc_completa = $_POST["doc_completa"];
$pagos_cancelados = $_POST["pagocancelado"];
$tramite_pendiente = $_POST["pendiente"];
$expte_reg = $_POST["expte_reg_nro"];
$expte_esc = $_POST["expte_esc_nro"];
$expte_esc_condicion = $_POST["expte_esc_condicion"];

$observaciones = $_POST["observaciones"];
$observaciones_esc = $_POST["observaciones_esc"];
$familia_matricula = $_POST["matricula"];
$barrio_nro = $_POST["barrio_nro"];
	$partidoSegunBarrio1 = mysql_query("SELECT * FROM dbo_barrio WHERE Barrio_nro = $barrio_nro");
	$partidoSegunBarrio = mysql_fetch_array($partidoSegunBarrio1);
	$pdoBarrio =  $partidoSegunBarrio["Partido_nro"];

$familia_domic = $_POST["familia_domic"];

$familia_cond_escrit = $_POST["condescrit"];

$familia_montoadj = $_POST["familia_montoadj"];
$familia_montoact = $_POST["familia_montoact"];
$familia_monto_actualizacion_fecha = cambiaf_a_mysql($_POST["familia_monto_actualizacion_fecha"]);
$familia_montoadj_pago = $_POST["familia_montoadj_pago"];
$familia_cancelacion_monto = $_POST["familia_cancelacion_monto"];
$familia_cancelacion_fecha = $_POST["familia_cancelacion_fecha"];
$familia_montoadj_cuotas = $_POST["familia_montoadj_cuotas"];
$familia_hipoteca_monto = $_POST["familia_hipoteca_monto"];
$familia_hipoteca_monto_fecha = $_POST["familia_hipoteca_monto_fecha"];

$blnProcrear = $_POST["procrear"];

$adjudicacion_pendiente = $_POST["adjudicacion_pendiente"];

$familia_ocupacion_verificar = $_POST["familia_ocupacion_verificar"];

$ausente = $_POST["ausente"];

$tarjeta_solic = $_POST["tarjeta_solic"];

$conflicto = $_POST["familia_conflicto"];

$planvivienda = $_POST["planvivienda"];

$plano_num = $_POST["plano_num"];

$plano_aprobado_fecha = $_POST["plano_aprobado_fecha"];

$plano_aprobado_fecha_mysql = cambiaf_a_mysql($plano_aprobado_fecha);

$fecha_escritura = cambiaf_a_mysql($_POST["fecha_escritura"]);

$decreto_compra = $_POST["decreto_compra"];


if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-' || $_POST["lote_circ"]=='0') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_secc"] || $_POST["lote_secc"]=='-' || $_POST["lote_secc"]=='0') {$lote_secc = '0';} else {$lote_secc = $_POST["lote_secc"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-' || $_POST["lote_ch"]=='0') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-' || $_POST["lote_qta"]=='0') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-' || $_POST["lote_fracc"]=='0') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};

if (!$_POST["lote_manzana_prov"] || $_POST["lote_manzana_prov"]=='-' || $_POST["lote_manzana_prov"]=='0') {$lote_manzana_prov = '0';} else {$lote_manzana_prov = $_POST["lote_manzana_prov"];};

if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-' || $_POST["lote_manzana"]=='0') {$lote_manzana = '0';} else {$lote_manzana = $_POST["lote_manzana"];};

if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-' || $_POST["lote_parcela"]=='0') {$lote_parcela = '0';} else {$lote_parcela = $_POST["lote_parcela"];};

if (!$_POST["lote_parcela_prov"] || $_POST["lote_parcela_prov"]=='-' || $_POST["lote_parcela_prov"]=='0') {$lote_parcela_prov = '0';} else {$lote_parcela_prov = $_POST["lote_parcela_prov"];};


if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-' || $_POST["lote_subpc"]=='0') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};



$upd = "UPDATE dbo_familia SET
	blnBoleto = '$blnBoleto',
	Boleto_fecha = '$boleto_fecha',
	Familia_res_adj = '$resolucion',
	Plano_num = '$plano_num',
	Plano_aprobado_fecha = '$plano_aprobado_fecha_mysql',
	Familia_doc_completa = '$doc_completa',
	Familia_domic = '$familia_domic',
	Familia_ocupacion_verificar = '$familia_ocupacion_verificar',
	Adjudicacion_pendiente = '$adjudicacion_pendiente',
	Familia_conflicto = '$conflicto',
	Familia_censo_ausente = '$ausente',
	Familia_tarjeta_solicitar = '$tarjeta_solic',
	Familia_monto_actualizacion = '$familia_montoact',
	Familia_monto_actualizacion_fecha = '$familia_monto_actualizacion_fecha',
	Familia_montoadj = '$familia_montoadj',
	Familia_montoadj_cuotas = '$familia_montoadj_cuotas',
	Familia_pagocancelado = '$pagos_cancelados',
	Familia_hipoteca_monto = '$familia_hipoteca_monto',
	Familia_hipoteca_monto_fecha = '$familia_hipoteca_monto_fecha',
	Familia_tramitependiente = '$tramite_pendiente',
	Familia_cond_escrit = '$familia_cond_escrit',
	Familia_escritura_fecha = '$fecha_escritura',
	Familia_matricula = '$familia_matricula',
	Planvivienda_nro = '$planvivienda',
	Familia_decreto_compra = '$decreto_compra',
	Expte_reg_nro = '$expte_reg',
	Expte_esc_nro = '$expte_esc',
	Expte_esc_condicion = '$expte_esc_condicion',
	Familia_observaciones = '$observaciones',
	Familia_observaciones_esc = '$observaciones_esc',
	Barrio_nro = '$barrio_nro',
	Partido_nro = '$pdoBarrio',
	Lote_circunscripcion = '$lote_circ',
	Lote_seccion = '$lote_secc',
	Lote_chacra = '$lote_ch',
	Lote_quinta = '$lote_qta',
	Lote_fraccion = '$lote_fracc',
	Lote_manzana = '$lote_manzana',
	Lote_manzana_prov = '$lote_manzana_prov',
	Lote_parcela = '$lote_parcela',
	Lote_parcela_prov = '$lote_parcela_prov',
	Lote_subparcela = '$lote_subpc',
	modif_usuario = '$log_usuario',
	modif_fecha = CURRENT_DATE
	where Familia_nro = '$idFamilia'";
	
	if (mysql_query($upd,$link))
	{ ?>
		<h2>Beneficio actualizado correctamente</h2>
		<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver al informe</a>

<? } else { ?>

		<h2>No se pudo actualizar la informaci&oacute;n</h2>
		<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver al informe</a></p>
<p>&nbsp;</p>
<? } ?>
<? } ?>