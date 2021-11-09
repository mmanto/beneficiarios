<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$expte_extracto = $_POST["extracto"];
$expte_obs = $_POST["observaciones"];

$expte_gescrit_estado = $_POST["expte_gescrit_estado"];


$expte_salida = cambiaf_a_mysql($_POST["envio_egg"]);

	$sql2 = "SELECT Direccion_nro FROM dbo_area WHERE Area_nro = $ubicacion_area";
	$res2 = mysql_query($sql2);
	$ubicacion = mysql_fetch_array($res2);
	$ubicacion_direccion = $ubicacion["Direccion_nro"];

$detalle = $_POST["detalle"];
$det_fecha = $_POST["detalle_fecha"];
$detalle_fecha2 = cambiaf_a_mysql($det_fecha);
$partido_nro = $_POST["idPartido"];
$beneficios = $_POST["beneficios"];


$usuario = $_POST["usuario"];
$expte_nro = $_POST["expte_nro"];


$sql = "UPDATE dbo_exptes SET
		Expte_extracto = '$expte_extracto',
		Expte_gescrit_estado = '$expte_gescrit_estado',
		Expte_ubicacion_direccion = '$ubicacion_direccion',
		Expte_ubicacion_detalle = '$detalle',
		Expte_ubicacion_detalle_fecha = '$detalle_fecha2',
		Expte_salida = '$expte_salida',				
		Expte_esc_observaciones = '$expte_obs',
		Partido_nro = '$partido_nro',
		Expte_beneficios = '$beneficios',
		Expte_modif_fecha = CURRENT_DATE,
		Expte_modif_hora = CURRENT_TIME,
		Expte_modif_usuario = '$usuario'
		WHERE Expte_nro = '$expte_nro'";

if(mysql_query($sql)) {echo "<h1>El expediente fue modificado correctamente</h1>"; }else{ echo "<h1>Error al dar de alta el expediente. Contacte al administrador</h1>";}

?>		
		
		
<p>Ya puede cerrar esta ventana | <? echo $det_fecha; ?> / <? echo $detalle_fecha2; ?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
include("pie.php");		
?>