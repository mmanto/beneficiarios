<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


$Plano_nro = $_POST["idPlano"];


$linkvar = $_POST["linkvar"];

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



$upd = "UPDATE dbo_plano SET
		Plano_codigo = '$Plano_codigo',
		Plano_expte = '$Plano_expte',
		Plano_cantparcelas = '$Plano_cantparcelas',
		Plano_normativa = '$Plano_normativa',
		Plano_localidad = '$Plano_localidad',
		Plano_barrio = '$Plano_barrio',
		Plano_circ = '$Plano_circ',
		Plano_secc = '$Plano_secc',
		Plano_ch = '$Plano_ch',
		Plano_qta = '$Plano_qta',
		Plano_fracc = '$Plano_fracc',
		Plano_manzana = '$Plano_manzana',
		Plano_parcela = '$Plano_parcela',
		Plano_subpc = '$Plano_subpc',
		Plano_partida = '$Plano_partida',
		Dominio_inscripcion = '$Dominio_inscripcion',
		Dominio_titular = '$Dominio_titular',
		infdominio_ingreso = '$Infdominio_ingreso',
		infdominio_salida = '$Infdominio_salida',
		circ10_ingreso = '$Circ10_ingreso',
		circ10_salida = '$Circ10_salida',
		previo_ingreso = '$Previo_ingreso',
		previo_salida = '$Previo_salida',
		visadocpa_ingreso = '$Visadocpa_ingreso',
		visadocpa_salida = '$Visadocpa_salida',
		visadosst_ingreso = '$Visadosst_ingreso',
		visadosst_salida = '$Visadosst_salida',
		visadoivba_ingreso = '$Visadoivba_ingreso',
		visadoivba_salida = '$Visadoivba_salida',
		visadootro_entrada = '$Visadootro_entrada',
		visadootro_salida = '$Visadootro_salida',
		visadomuni_entrada = '$Visadomuni_entrada',
		visadomuni_salida = '$Visadomuni_salida',
		aprobacion_entrada = '$Aprobacion_entrada',
		aprobacion_salida = '$Aprobacion_salida',
		registracion_entrada = '$Registracion_entrada',
		registracion_salida = '$Registracion_salida',
		comunic_entrada = '$Comunic_entrada',
		comunic_salida = '$Comunic_salida',
		plano_observ = '$Plano_observ'
		where Plano_nro = '$Plano_nro'";

		if(mysql_query($upd,$link)) {
		
		?>
		<h2>Plano actualizado correctamente</h2> 
		<p><a href="planos_listar.php?<? echo $linkvar; ?>">Volver al listado</a></p>
		<p><a href="menu.php?<? echo $linkvar; ?>">Volver al panel de administraci&oacute;n</p>
		
		<?
				
		}else{
		
		echo "El plano no pudo ser actualizado. Por favor contacte al administrador";
		echo "<p><a href=\"menu.php?<? echo $linkvar; ?>\">Volver al panel de administraci&oacute;n</p>";
		
		}