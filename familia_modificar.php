<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

//Definición de variables

//Datos del usuario y direccion (recogidos por GET)
$log_usuario = $_POST["idUsuario"];
$log_direccion = $_POST["idDireccion"];
$log_nivel = $_POST["user_nivel"];
$direccion_nro = $log_direccion;

//Resto de los datos, recogidos por POST
$familia_cant_menores = $_POST["familia_cant_menores"];
$familia_cant_mayores = $_POST["familia_cant_mayores"];
$familia_acargo = $_POST["familia_acargo"];
$familia_reciben_ingresos = $_POST["familia_reciben_ingresos"];
$familia_monto = $_POST["familia_monto"];
$familia_conviven = $_POST["familia_conviven"];
$familia_ingreso_total = $_POST["familia_ingreso_total"];
$familia_observaciones = $_POST["familia_observacion"];
$fecha_ingreso_lote = $_POST["fecha_ingreso_lote"];
$forma_ingreso = $_POST["forma_ingreso"];
$tipo_ocupacion = $_POST["tipo_ocupacion"];
$forma_ocupacion = $_POST["forma_ocupacion"];
$expediente_nro = $_POST["expediente_nro"];
$posee_otraprop = $_POST["posee_otraprop"];
$otraprop_lugar = $_POST["otraprop_lugar"];
$chequera_paga = $_POST["chequera_paga"];
$chequera_nro = $_POST["chequera_nro"];
$chequera_titular = $_POST["chequera_titular"];
$chequera_monto = $_POST["chequera_monto"];
$chequera_cuotas = $_POST["chequera_cuotas"];
$chequera_ultimo_pago = $_POST["chequera_ultimo_pago"];
$chequera_emisor = $_POST["chequera_emisor"];
$chequera_emisor_otro = $_POST["chequera_emisor_otro"];
$familia_acepta_ley = $_POST["familia_acepta_ley"];
$familia_doc_obs = $_POST["familia_doc_obs"];
$familia_nro = $_POST["Familia_nro"];

//$expediente_fecha_mysql = cambiaf_a_mysql($expediente_fecha);
$fecha_ingreso_lote_mysql = cambiaf_a_mysql($fecha_ingreso_lote);

//Update de familia (Ojo: falta agregar expte. fecha!)

$updFlia = "UPDATE dbo_familia SET
Familia_cant_mayores='$familia_cant_mayores',
Familia_cant_menores='$familia_cant_menores',
Familia_acargo='$familia_acargo',
Familia_reciben_ingresos='$familia_reciben_ingresos',
Familia_monto='$familia_monto',
Familia_conviven='$familia_conviven',
Familia_ingreso_total='$familia_ingreso_total',
Familia_observaciones='$familia_observaciones',
Fecha_ingreso_lote='$fecha_ingreso_lote_mysql',
Forma_ingreso='$forma_ingreso',
Tipo_ocupacion='$tipo_ocupacion',
Forma_ocupacion='$forma_ocupacion',
Expediente_nro='$expediente_nro',
Posee_otraprop='$posee_otraprop',
Otraprop_lugar='$otraprop_lugar',
Chequera_paga='$chequera_paga',
Chequera_nro='$chequera_nro',
Chequera_titular='$chequera_titular',
Chequera_monto='$chequera_monto',
Chequera_cuotas='$chequera_cuotas',
Chequera_ultimo_pago='$chequera_ultimo_pago',
Chequera_emisor='$chequera_emisor',
Chequera_emisor_otro='$chequera_emisor_otro',
Familia_acepta_ley='$familia_acepta_ley',
Familia_doc_obs='$familia_doc_obs'
WHERE Familia_nro = '$familia_nro'";

if(!mysql_query($updFlia,$link)) {echo "<h4>Error - No se ha podido realizar la operación</h4>";} else {
 ?>
<body>
<h2>Los cambios han sido guardados </h2>
<p><? /*<a href="menu.php?nbsp567=<?=$log_direccion ?>&qprst645=<?=$log_usuario ?>&ghlst251=<?=$log_nivel ?>">Dar de alta otra encuesta</a></p> */?>
</body>
</html>
<?
}
?>