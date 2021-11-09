<? session_start();

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

$idFamilia = $_POST["idFamilia"];

$idPartido = $_POST["idPartido"];

$beneficio_origen = '3';

$escribano_registro = $_POST["escribano_registro"];

$escribano_nombre = $_POST["escribano_nombre"];

$expte_ley_reg_num = $_POST["expte_ley_reg_num"];

$expte_ley_cons_num = $_POST["expte_ley_cons_num"];

$partida = $_POST["partida"];

$escritura_fecha = $_POST["escritura_fecha"];

$escritura_fecha = cambiaf_a_mysql($escritura_fecha);


$escritura_insc_fecha = $_POST["escritura_insc_fecha"];

$escritura_insc_fecha = cambiaf_a_mysql($escritura_insc_fecha);


$escritura_numero = $_POST["escritura_numero"];

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


//Definicion de variables de persona 2
$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];
if (!$_POST["t2_doc_nro"] || $_POST["t2_doc_nro"]=='-') {$t2_doc_nro = '0';}else{$t2_doc_nro = $_POST["t2_doc_nro"];}
$t2_ecivil = $_POST["t2_ecivil"];



// Insert de familia con los datos ingresados:

	$updFlia = "UPDATE dbo_familia set
	Partido_nro = '$idPartido',
	Lote_circunscripcion = '$lote_circ',
	Lote_seccion = '$lote_secc',
	Lote_chacra = '$lote_ch',
	Lote_quinta = '$lote_qta',
	Lote_fraccion = '$lote_fracc',
	Lote_manzana = '$lote_manzana_limp',
	Lote_parcela = '$lote_parcela_limp',
	Lote_subparcela = '$lote_subpc',
	Expte_ley_registro = '$escribano_registro',
	Expte_ley_escribano_nombre = '$escribano_nombre',
	Expte_ley_alta_instancia = '$alta_instancia',
	Expte_ley_reg_num = '$expte_ley_reg_num',
	Expte_ley_cons_num = '$expte_ley_cons_num',
	Lote_partida = '$partida',
	Familia_escritura = '$escritura_numero',
	Familia_escritura_fecha = '$escritura_fecha',	
	Familia_escritura_insc_fecha = '$escritura_insc_fecha',
	Familia_observaciones_esc = '$familia_observaciones',
	modif_usuario = '$log_usuario',
	modif_fecha = CURRENT_DATE
	where Familia_nro = '$idFamilia'";

	if (mysql_query($updFlia,$link)) { ?>
	
			
<h2>Beneficiario actualizado correctamente</h2> 
<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver al informe</a></p>

<?

}else{ ?>

<h1>No se pudo actualizar el registro. Por favor contactese con el administrador</h1>
<p><a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver al informe</a></p>


<? } } ?>