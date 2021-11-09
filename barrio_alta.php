<? session_start();

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idPartido = $_POST["idPartido"];
$barrio_nombre = $_POST["barrio_nombre"];
$barrio_conurbano = $_POST["conurbano"];

if (!$_POST["barrio_plano"] || $_POST["barrio_plano"]=='-') {$barrio_plano = '0';} else {$barrio_plano = $_POST["barrio_plano"];};

if(!$_POST["barrio_plano_aprob_fecha"]) { $barrio_plano_aprob_fecha = "0000-00-00"; }else{
	$barrio_plano_aprob_fecha = cambiaf_a_mysql($_POST["barrio_plano_aprob_fecha"]);


if (!$_POST["barrio_circ"] || $_POST["barrio_circ"]=='-') {$barrio_circ = '0';} else {$barrio_circ = $_POST["barrio_circ"];};
if (!$_POST["barrio_secc"] || $_POST["barrio_secc"]=='-') {$barrio_secc = '0';} else {$barrio_secc = $_POST["barrio_secc"];};
if (!$_POST["barrio_ch"] || $_POST["barrio_ch"]=='-') {$barrio_ch = '0';} else {$barrio_ch = $_POST["barrio_ch"];};
if (!$_POST["barrio_qta"] || $_POST["barrio_qta"]=='-') {$barrio_qta = '0';} else {$barrio_qta = $_POST["barrio_qta"];};
if (!$_POST["barrio_fracc"] || $_POST["barrio_fracc"]=='-') {$barrio_fracc = '0';} else {$barrio_fracc = $_POST["barrio_fracc"];};

//Nuevos valores

if (!$_POST["barrio_parcelas_cant"] || $_POST["barrio_parcelas_cant"]=='-') {$barrio_parcelas_cant = '0';} else {$barrio_parcelas_cant = $_POST["barrio_parcelas_cant"];};

if (!$_POST["barrio_valor_exprop"] || $_POST["barrio_valor_exprop"]=='-') {$barrio_valor_exprop = '0';} else {$barrio_valor_exprop = $_POST["barrio_valor_exprop"];};

if (!$_POST["barrio_valor_exprop_fecha"] || $_POST["barrio_valor_exprop_fecha"]=='-') {$barrio_valor_exprop_fecha = '0';} else {$barrio_valor_exprop_fecha = cambiaf_a_mysql($_POST["barrio_valor_exprop_fecha"]);};

if (!$_POST["barrio_sup_total"] || $_POST["barrio_sup_total"]=='-') {$barrio_sup_total = '0';} else {$barrio_sup_total = $_POST["barrio_sup_total"];};

if (!$_POST["barrio_m2_valor"] || $_POST["barrio_m2_valor"]=='-') {$barrio_m2_valor = '0';} else {$barrio_m2_valor = $_POST["barrio_m2_valor"];};

if (!$_POST["barrio_m2_valor_fecha"] || $_POST["barrio_m2_valor_fecha"]=='-') {$barrio_m2_valor_fecha = '0';} else {$barrio_m2_valor_fecha = cambiaf_a_mysql($_POST["barrio_m2_valor_fecha"]);};

if (!$_POST["barrio_superficie_comun"] || $_POST["barrio_superficie_comun"]=='-') {$barrio_superficie_comun = '0';} else {$barrio_superficie_comun = $_POST["barrio_superficie_comun"];};

if (!$_POST["barrio_mensura_valor"] || $_POST["barrio_mensura_valor"]=='-') {$barrio_mensura_valor = '0';} else {$barrio_mensura_valor = $_POST["barrio_mensura_valor"];};

if (!$_POST["barrio_cuotas_cant"] || $_POST["barrio_cuotas_cant"]=='-') {$barrio_cuotas_cant = '0';} else {$barrio_cuotas_cant = $_POST["barrio_cuotas_cant"];};

$planvivienda = $_POST["planvivienda"];

$observaciones = $_POST["observaciones"];

$origen = $_POST["origen"];

$ins = "INSERT INTO dbo_barrio (
	Partido_nro,
	Barrio_conurbano,
	Barrio_nombre,
	Barrio_plano,
	Barrio_plano_aprob_fecha,
	Barrio_parcelas_cant,
	Barrio_circunscripcion,
	Barrio_seccion,
	Barrio_chacra,
	Barrio_quinta,
	Barrio_fraccion,
	Barrio_valor_exprop,
	Barrio_valor_exprop_fecha,
	Barrio_sup_total,
	Barrio_m2_valor_actual,
	Barrio_m2_valor_fecha,
	Barrio_superficie_comun,
	Barrio_mensura_valor,
	Barrio_cuotas_cant,
	Planvivienda_nro,
	Barrio_observaciones
	) VALUES (
	'$idPartido',
	'$barrio_conurbano',
	'$barrio_nombre',
	'$barrio_plano',
	'$barrio_plano_aprob_fecha',
	'$barrio_parcelas_cant',
	'$barrio_circ',
	'$barrio_secc',
	'$barrio_ch',
	'$barrio_qta',
	'$barrio_fracc',
	'$barrio_valor_exprop',
	'$barrio_valor_exprop_fecha',
	'$barrio_sup_total',
	'$barrio_m2_valor',
	'$barrio_m2_valor_fecha',
	'$barrio_superficie_comun',
	'$barrio_mensura_valor',
	'$barrio_cuotas_cant',
	'$planvivienda',
	'$observaciones'		
	)";
	
	if (!mysql_query($ins)) { ?>
	
		<h2>Error. No se pudo completar la acci&oacute;n. Contacte al administrador</h2>
		<p><a href="barrios_listar_partido.php?idPartido=<?=$idPartido; ?>">Volver al listado</a></p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	

	
<?	}else{ ?>

<h2>El barrio fue dado de alta correctamente.</h2>
<p>&nbsp;</p>
<p><a href="barrios_listar_partido.php?idPartido=<?=$idPartido; ?>">Volver al listado</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?       
}
include "pie.php";

} ?>
