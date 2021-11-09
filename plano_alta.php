<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$Plano_dirprov = $_POST["plano_dirprov"];
$Plano_direccion = $_POST["plano_direccion"];
$Plano_insert_fecha = cambiaf_a_mysql($_POST["plano_insert_fecha"]);
$Plano_codigo = $_POST["plano_codigo"];
$Plano_expte = $_POST["plano_expte"];
$Plano_cantparcelas = $_POST["plano_cantparcelas"];
$Plano_normativa = $_POST["plano_normativa"];
$idPartido = $_POST["idPartido"];
$Plano_localidad = $_POST["plano_localidad"];
$Plano_barrio = $_POST["plano_barrio"];



if (!$_POST["plano_circ"] || $_POST["plano_circ"]=='-') {$Plano_circ = '0';} else {$Plano_circ = $_POST["plano_circ"];};

if (!$_POST["plano_secc"] || $_POST["plano_secc"]=='-') {$Plano_secc = '0';} else {$Plano_secc = $_POST["plano_secc"];};

if (!$_POST["plano_ch"] || $_POST["plano_ch"]=='-') {$Plano_ch = '0';} else {$Plano_ch = $_POST["plano_ch"];};

if (!$_POST["plano_qta"] || $_POST["plano_qta"]=='-') {$Plano_qta = '0';} else {$Plano_qta = $_POST["plano_qta"];};

if (!$_POST["plano_fracc"] || $_POST["plano_fracc"]=='-') {$Plano_fracc = '0';} else {$Plano_fracc = $_POST["plano_fracc"];};

if (!$_POST["plano_manzana"] || $_POST["plano_manzana"]=='-') {$Plano_manzana = '0';} else {$Plano_manzana = $_POST["plano_manzana"];};

if (!$_POST["plano_parcela"] || $_POST["plano_parcela"]=='-') {$Plano_parcela = '0';} else {$Plano_parcela = $_POST["plano_parcela"];};

if (!$_POST["plano_subpc"] || $_POST["plano_subpc"]=='-') {$Plano_subpc = '0';} else {$Plano_subpc = $_POST["plano_subpc"];};


$Plano_partida = $_POST["plano_partida"];
$Dominio_inscripcion = $_POST["dominio_inscripcion"];
$Dominio_titular = $_POST["dominio_titular"];
$Plano_observ = $_POST["plano_observ"];

$Infdominio_ingreso = cambiaf_a_mysql($_POST["infdominio_ingreso"]);
$Infdominio_salida = cambiaf_a_mysql($_POST["infdominio_salida"]);
$Circ10_ingreso = cambiaf_a_mysql($_POST["circ10_ingreso"]);
$Circ10_salida = cambiaf_a_mysql($_POST["circ10_salida"]);
$Previo_ingreso = cambiaf_a_mysql($_POST["previo_ingreso"]);
$Previo_salida = cambiaf_a_mysql($_POST["previo_salida"]);
$Visadocpa_ingreso = cambiaf_a_mysql($_POST["visadocpa_ingreso"]);
$Visadocpa_salida = cambiaf_a_mysql($_POST["visadocpa_salida"]);
$Visadosst_ingreso = cambiaf_a_mysql($_POST["visadosst_ingreso"]);
$Visadosst_salida = cambiaf_a_mysql($_POST["visadosst_salida"]);
$Visadoivba_ingreso = cambiaf_a_mysql($_POST["visadoivba_ingreso"]);
$Visadoivba_salida = cambiaf_a_mysql($_POST["visadoivba_salida"]);
$Visadootro_entrada = cambiaf_a_mysql($_POST["visadootro_entrada"]);
$Visadootro_salida = cambiaf_a_mysql($_POST["visadootro_salida"]);
$Visadomuni_entrada = cambiaf_a_mysql($_POST["visadomuni_entrada"]);
$Visadomuni_salida = cambiaf_a_mysql($_POST["visadomuni_salida"]);
$Aprobacion_entrada = cambiaf_a_mysql($_POST["aprobacion_entrada"]);
$Aprobacion_salida = cambiaf_a_mysql($_POST["aprobacion_salida"]);
$Registracion_entrada = cambiaf_a_mysql($_POST["registracion_entrada"]);
$Registracion_salida = cambiaf_a_mysql($_POST["registracion_salida"]);
$Comunic_entrada = cambiaf_a_mysql($_POST["comunic_entrada"]);
$Comunic_salida = cambiaf_a_mysql($_POST["comunic_salida"]);







$ins = "INSERT INTO dbo_plano (
		Plano_dirprov,
		Plano_direccion,
		Plano_insert_fecha,
		Plano_codigo,
		Plano_expte,
		Plano_cantparcelas,
		Plano_normativa,
		idPartido,
		Plano_localidad,
		Plano_barrio,
		Plano_circ,
		Plano_secc,
		Plano_ch,
		Plano_qta,
		Plano_fracc,
		Plano_manzana,
		Plano_parcela,
		Plano_subpc,
		Plano_partida,
		Dominio_inscripcion,
		Dominio_titular,
		infdominio_ingreso,
		infdominio_salida,
		circ10_ingreso,
		circ10_salida,
		previo_ingreso,
		previo_salida,
		visadocpa_ingreso,
		visadocpa_salida,
		visadosst_ingreso,
		visadosst_salida,
		visadoivba_ingreso,
		visadoivba_salida,
		visadootro_entrada,
		visadootro_salida,
		visadomuni_entrada,
		visadomuni_salida,
		aprobacion_entrada,
		aprobacion_salida,
		registracion_entrada,
		registracion_salida,
		comunic_entrada,
		comunic_salida,
		plano_observ
		)VALUES(
		'$Plano_dirprov',
		'$Plano_direccion',
		'$Plano_insert_fecha',
		'$Plano_codigo',
		'$Plano_expte',
		'$Plano_cantparcelas',
		'$Plano_normativa',
		'$idPartido',
		'$Plano_localidad',
		'$Plano_barrio',
		'$Plano_circ',
		'$Plano_secc',
		'$Plano_ch',
		'$Plano_qta',
		'$Plano_fracc',
		'$Plano_manzana',
		'$Plano_parcela',
		'$Plano_subpc',
		'$Plano_partida',
		'$Dominio_inscripcion',
		'$Dominio_titular',
		'$Infdominio_ingreso',
		'$Infdominio_salida',
		'$Circ10_ingreso',
		'$Circ10_salida',
		'$Previo_ingreso',
		'$Previo_salida',
		'$Visadocpa_ingreso',
		'$Visadocpa_salida',
		'$Visadosst_ingreso',
		'$Visadosst_salida',
		'$Visadoivba_ingreso',
		'$Visadoivba_salida',
		'$Visadootro_entrada',
		'$Visadootro_salida',
		'$Visadomuni_entrada',
		'$Visadomuni_salida',
		'$Aprobacion_entrada',
		'$Aprobacion_salida',
		'$Registracion_entrada',
		'$Registracion_salida',
		'$Comunic_entrada',
		'$Comunic_salida',
		'$Plano_observ')";
		
		if(mysql_query($ins,$link)) {
		
		?>
		<h2>Plano cargado correctamente</h2> 
		<p><a href="plano_alta_form.php?<? echo $linkvar; ?>">Cargar otro plano</a></p>
		<p><a href="menu.php?<? echo $linkvar; ?>">Volver al panel de administraci&oacute;n</p>
		
		<?
				
		}else{
		
		echo "El plano no pudo ser cargado. Por favor contacte al administrador";
		echo "<p><a href=\"menu.php?<? echo $linkvar; ?>\">Volver al panel de administraci&oacute;n</p>";
		
		}