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
$expediente_fecha = $_POST["expediente_fecha"];
$p1_caracter = $_POST["p1_caracter"];
$p1_nombre = $_POST["p1_nombre"];
$p1_doctipo = $_POST["p1_doctipo"];
$p1_documento = $_POST["p1_documento"];
$p2_caracter = $_POST["p2_caracter"];
$p2_nombre = $_POST["p2_nombre"];
$p2_doctipo = $_POST["p2_doctipo"];
$p2_documento = $_POST["p2_documento"];
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
$expte_ivba = $_POST["expte_ivba"];
$expte_ivba_alc = $_POST["expte_ivba_alc"];
$fecha_envio_egg = $_POST["fecha_envio_egg"];
$escritura_nro = $_POST["Escritura_nro"];
$escritura_fecha = $_POST["Escritura_fecha"];
$escritura_decreto = $_POST["Escritura_decreto"];


$expediente_fecha_mysql = cambiaf_a_mysql($expediente_fecha);
$fecha_envio_egg_mysql = cambiaf_a_mysql($fecha_envio_egg);
$escritura_fecha_mysql = cambiaf_a_mysql($escritura_fecha);

$fecha_ingreso_lote_mysql = cambiaf_a_mysql($fecha_ingreso_lote);

//Update de familia

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
Expediente_fecha='$expediente_fecha_mysql',
P1_caracter='$p1_caracter',
P1_nombre='$p1_nombre',
P1_doctipo='$p1_doctipo',
P1_documento='$p1_documento',
P2_caracter='$p2_caracter',
P2_nombre='$p2_nombre',
P2_doctipo='$p2_doctipo',
P2_documento='$p2_documento',
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
Familia_doc_obs='$familia_doc_obs',
Expediente_ivba_nro = '$expte_ivba',
Expediente_ivba_alc = '$expte_ivba_alc',
Envio_ivba_fecha = '$fecha_envio_egg_mysql'
WHERE Familia_nro = '$familia_nro'";

if(!mysql_query($updFlia,$link)) {echo "<h4>Error - No se ha podido realizar la operación</h4>";} else {



//--> Inserto la Escritura


	$dbo_tabla_escritura = "dbo_escritura";

	$insEsc = "INSERT INTO $dbo_tabla_escritura (
	Escritura_numero,
	Escritura_fecha,
	Escritura_decreto,
	Familia_nro
	) VALUES (
	'$escritura_nro',
	'$escritura_fecha_mysql',
	'$escritura_decreto',
	'$familia_nro')";

	if (@mysql_query($insEsc,$link)) {
	$id_Escritura = mysql_insert_id();
	}else{
	echo "No se pudo realizar la insercion de Escritura";}


 ?>
<body>
<h3>La encuesta ha sido procesada con &eacute;xito </h3>
<p><a href="enc_alta_frente.php?nbsp567=<?=$log_direccion ?>&qprst645=<?=$log_usuario ?>&ghlst251=<?=$log_nivel ?>">Dar de alta otra encuesta</a></p>
<p><a href="menu.php?nbsp567=<?=$log_direccion ?>&qprst645=<?=$log_usuario ?>&ghlst251=<?=$log_nivel ?>">Volver al panel de administración</a><p>
</body>
</html>
<?
}
?>