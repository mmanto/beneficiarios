<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

if(!$_POST["caracteristica"] || !$_POST["exptenum"] || !$_POST["anio"]) { ?>

<h1>Por favor complete todo los datos</h1>
<p><a href="javascript:history.back(-1)" >Volver</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? }else{

$expte_caract = $_POST["caracteristica"];
$expte_partido = $_POST["partido"];
$expte_rnrd = $_POST["rnrd"];
	if($expte_rnrd != '0') {$ley24374 = '1'; }else{ $ley24374 = '0';}

$expte_num = $_POST["exptenum"];
$expte_anio = $_POST["anio"];
$expte_alcance = $_POST["alcance"];
$expte_cuerpos = $_POST["cuerpos"];
$expte_extracto = $_POST["extracto"];
$expte_obs = $_POST["observaciones"];
$expte_origen = $_POST["origen"];
$usuario = $_POST["usuario"];
$ubicacion_area = $_POST["area"];
	$sql3 = "SELECT Direccion_nro FROM dbo_area WHERE Area_nro = $ubicacion_area";
	$res3 = mysql_query($sql3);
	$ubicacion = mysql_fetch_array($res3);
	$ubicacion_direccion = $ubicacion["Direccion_nro"];

$fojas = $_POST["fojas"];
$expte_consolidacion = $_POST["consolidacion"];

$expte_esc = $_POST["blnEsc"];
	if($expte_esc == '1') {$expte_esc = '1'; }else{ $expte_esc = '0';}
$Partido_nro = $_POST["idPartido"];

if(!$_POST["envio_egg"]) {$fecha_envio_egg = "0000-00-00";}else{$fecha_envio_egg = cambiaf_a_mysql($_POST["envio_egg"]);}

//Verifico si el expediente ya existe en el sistema

$sql2 = "SELECT * FROM dbo_exptes WHERE Expte_caract = $expte_caract AND Expte_partido = $expte_partido AND Expte_rnrd = $expte_rnrd AND Expte_num = $expte_num AND Expte_anio = $expte_anio AND Expte_alcance = $expte_alcance";
$res2 = mysql_query($sql2);
$cant = mysql_fetch_array($res2);

if($cant > 1) {

?>
<h1>El expediente ya existe en el sistema</h1>
<p>Por favor verifique la información</p>
<p><a href="javascript:history.back(-1)" >Volver</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? 
}else{

$sql = "INSERT INTO dbo_exptes (
		Expte_caract,
		Expte_partido,
		Expte_rnrd,
		Expte_num,
		Expte_anio,
		Expte_alcance,
		Expte_cuerpos_cant,
		Expte_extracto,
		Expte_observaciones,
		Expte_24374,
		Expte_ley_cons,
		Expte_esc,
		Partido_nro,
		Expte_salida,
		Expte_origen,
		Expte_alta_fecha,
		Expte_alta_hora,
		Expte_ubicacion_area,
		Expte_ubicacion_direccion,
		Expte_fojas_origen,
		Expte_fojas_actual,
		Expte_alta_usuario,
		blnActivo
		)VALUES(
		'$expte_caract',
		'$expte_partido',
		'$expte_rnrd',
		'$expte_num',
		'$expte_anio',
		'$expte_alcance',
		'$expte_cuerpos',
		'$expte_extracto',
		'$expte_obs',
		'$ley24374',
		'$expte_consolidacion',
		'$expte_esc',
		'$Partido_nro',
		'$fecha_envio_egg',
		'$expte_origen',
		CURRENT_DATE,
		CURRENT_TIME,
		'$ubicacion_area',
		'$ubicacion_direccion',
		'$fojas',
		'$fojas',
		'$usuario',
		'1')";

if(mysql_query($sql)) {echo "<h1>El expediente fue dado de alta correctamente</h1>"; }else{ echo "<h1>Error al dar de alta el expediente. Contacte al administrador</h1><p><a href=\"expte-alta-form.php\">Volver</a></p>";}

?>		
		
		
<p><a href="expte-alta-form.php">Dar de alta otro expediente</a> | <a href="exptes-listar-area.php">Volver al inicio</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
	}
}
include("pie.php");		
?>