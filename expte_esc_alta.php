<?


if($_POST["expte_origen"] == '0') {

?>

<h2>Por favor, seleccione una direccion de origen</h2>
<p> <a href="javascript:history.back(1)">Volver</a></p>

<? }else{

if($_POST["idPartido"] == '0') {

?>

<h2>Por favor, seleccione un partido</h2>
<p> <a href="javascript:history.back(1)">Volver</a></p>

<? }else{


include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$Expte_dirprov = $_POST["expte_dirprov"];
$Expte_direccion = $_POST["expte_direccion"];
$Expte_insert_fecha = cambiaf_a_mysql($_POST["expte_insert_fecha"]);
$Expte_caract = $_POST["expte_caract"];
$Expte_num = $_POST["expte_num"];
$Expte_anio = $_POST["expte_anio"];

if (!$_POST["expte_alcance"] || $_POST["expte_alcance"]=='-') {$Expte_alcance = '0';} else {$Expte_alcance = $_POST["expte_alcance"];};

if (!$_POST["expte_cuerpo"] || $_POST["expte_cuerpo"]=='-') {$Expte_cuerpo = '0';} else {$Expte_cuerpo = $_POST["expte_cuerpo"];};

$idPartido = $_POST["idPartido"];
$Expte_barrio = $_POST["expte_barrio"];
$Expte_envio_egg = cambiaf_a_mysql($_POST["expte_envio_egg"]);
$Expte_beneficios = $_POST["expte_beneficios"];
$Expte_mov = $_POST["expte_mov"];
$Expte_fechamov = cambiaf_a_mysql($_POST["expte_fechamov"]);
$Expte_origen = $_POST["expte_origen"];
$Expte_destino = $_POST["expte_destino"];
$Expte_obs = $_POST["Expte_obs"];

$ins = "INSERT INTO dbo_expte_esc (
		Expte_dirprov,
		Expte_insert_fecha,
		Expte_caract,
		Expte_num,
		Expte_anio,
		Expte_alcance,
		Expte_cuerpo,
		Expte_origen,
		Expte_salida_destino,
		idPartido,
		Barrio_nro,
		Expte_envio_egg,
		Expte_mov,
		Expte_fechamov,
		Expte_beneficios,
		Expte_observaciones
		)VALUES(
		'7',
		'$Expte_insert_fecha',
		'$Expte_caract',
		'$Expte_num',
		'$Expte_anio',
		'$Expte_alcance',
		'$Expte_cuerpo',
		'$Expte_origen',
		'$Expte_destino',
		'$idPartido',
		'$Expte_barrio',
		'$Expte_envio_egg',
		'$Expte_mov',
		'$Expte_fechamov',
		'$Expte_beneficios',
		'$Expte_obs')";
		
		if(mysql_query($ins,$link)) {
		
		?>
		<h2>Expte cargado correctamente</h2> 
		<p><a href="barrios_listar_exptes.php">Volver al listado de barrios</a></p>
		<p><a href="menu.php">Volver al panel de administraci&oacute;n</p>
		
		<?
				
		}else{
		
		echo "El expte no pudo ser cargado. Por favor contacte al administrador";
		echo "<p><a href=\"expte_esc_alta_form.php\">Volver</p>";
		
		}
} } ?>