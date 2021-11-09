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

$idFamilia = $_POST["idFamilia"];
$origen = $_POST["origen"];

//Definicion de variables 

$telefono = $_POST["familia_telefono"];
$resolucion = $_POST["resolucion"];
$doc_completa = $_POST["doc_completa"];
$pagos_cancelados = $_POST["pagocancelado"];
$tramite_pendiente = $_POST["pendiente"];
$expte_esc = $_POST["expte_esc_nro"];
$observaciones = $_POST["observaciones"];
$familia_matricula = $_POST["matricula"];
$Partido_nro = $_POST["idPartido"];
$familia_cond_escrit = $_POST["condescrit"];

if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-' || $_POST["lote_circ"]=='0') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_secc"] || $_POST["lote_secc"]=='-' || $_POST["lote_secc"]=='0') {$lote_secc = '0';} else {$lote_secc = $_POST["lote_secc"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-' || $_POST["lote_ch"]=='0') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-' || $_POST["lote_qta"]=='0') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-' || $_POST["lote_fracc"]=='0') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-' || $_POST["lote_manzana"]=='0') {$lote_manzana = '0';} else {$lote_manzana = $_POST["lote_manzana"];};
if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-' || $_POST["lote_parcela"]=='0') {$lote_parcela = '0';} else {$lote_parcela = $_POST["lote_parcela"];};
if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-' || $_POST["lote_subpc"]=='0') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};



$upd = "UPDATE dbo_familia SET
	Familia_telefono = '$telefono',
	Familia_res_adj = '$resolucion',
	Familia_doc_completa = '$doc_completa',
	Familia_pagocancelado = '$pagos_cancelados',
	Familia_tramitependiente = '$tramite_pendiente',
	Familia_cond_escrit = '$familia_cond_escrit',
	Familia_matricula = '$familia_matricula',
	Expte_esc_nro = '$expte_esc',
	Familia_observaciones = '$observaciones',
	Partido_nro = '$Partido_nro',
	Lote_circunscripcion = '$lote_circ',
	Lote_seccion = '$lote_secc',
	Lote_chacra = '$lote_ch',
	Lote_quinta = '$lote_qta',
	Lote_fraccion = '$lote_fracc',
	Lote_manzana = '$lote_manzana',
	Lote_parcela = '$lote_parcela',
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



