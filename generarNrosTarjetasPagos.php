<?php 
/* Recibe un número de resolución
 * si ya se genero el listado de tarjetas
 * se levanta el archivo
 * sino se generan los números de tarjetas
 */ 
session_start();
if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
require ("funciones.php");
include ("cabecera.php");
}

$nroResolucion = $_POST['nroResolucion'];

$qryDatos = "SELECT idResolucion, Resolucion_partido, Resolucion_barrio_nro, Path_listado_tarjetas
				FROM dbo_resolucion WHERE  Resolucion_nombre LIKE '$nroResolucion'";
$rs_datos = armar_matriz($qryDatos);
$id_Resolucion = $rs_datos[0]['idResolucion'];
$path_listado = $rs_datos[0]['Path_listado_tarjetas'];
$_res = str_replace('/', '_', $nroResolucion);

//Si ya fue generado el listado no lo vuelvo a generar
//sino cambiaría los números de tarjetas de pago de cada titular
if ($path_listado == '') {
	generarListadoNros($id_Resolucion, $_res);
	$hoy = date("Ymd");	
	$archivo = "$_res";
} else {
	$archivo = "$path_listado";
}

function generarListadoNros($id_Resolucion, $_res) {
//Obtengo los titulares
$sql2 = "SELECT	s.Lote_nro,
				p.Persona_dni_nro, 
				p.Persona_nombre, 
				p.Persona_apellido, 
				p.Familia_nro
		FROM dbo_persona AS p
		JOIN (	SELECT 	l.Lote_nro, 
						f.Familia_nro AS flia_nro
				FROM dbo_lote AS l
				JOIN dbo_familia AS f 
				ON l.Lote_nro = f.Lote_nro
				WHERE f.Familia_id_resolucion = $id_Resolucion ) AS s 
		ON p.Familia_nro = s.flia_nro
		ORDER BY Lote_nro, Familia_nro";

$resultado = armar_matriz($sql2);
$cant2 = count($resultado);

$hoy = date("Ymd");
$nombreArchivo = "$_res";

//TODO: lo guardo con nro de resolucion o ALT20130325
$ar=fopen("tarjetasDePago/$nombreArchivo.txt","w") or
    die("Problemas en la creacion");

fputs($ar,"                 ALT$hoy");
fputs($ar,"\r\n");
 
//Discrimino un titular por lote
$i = 0;
while ($i < $cant2) {
	//El nro_tarjeta lo guardo en la tabla lote y lo levanto con $sql2
	$apellido = trim($resultado[$i]['Persona_apellido']);
	$nombre = trim($resultado[$i]['Persona_nombre']);
	$nroCliente = obtenerNroCliente();
	$nroTarjeta = obtenerNroTarjeta($nroCliente);
	asignarNroTarjetaAlLote($nroTarjeta, $resultado[$i]['Lote_nro'] );
	fputs($ar,"$nroTarjeta $apellido $nombre\r\n");
	do { 
		$i++; 
		//Incremento titulares hasta el próximo lote
	} while ($i < $cant2 && $resultado[$i-1]['Lote_nro'] == $resultado[$i]['Lote_nro']); 
}

fclose($ar);

$fechaGenera = date("Y-m-d");	
$qry = "update dbo_resolucion 
		set Path_listado_tarjetas = '$_res',
		    Fecha_genera_nros_tarjetas = '$fechaGenera'
		WHERE idResolucion = $id_Resolucion";
mysql_query($qry);


}

function obtenerNroCliente(){
	//1) obtener Nro_cliente
	$qry = "SELECT nro_cliente FROM dbo_nro_cliente";
	$rs = armar_matriz($qry);
	$nroCliente = $rs[0][nro_cliente]; 
	//2) incrementar Nro_cliente
	$proximoNroCliente = $nroCliente + 1;
	$qry = "UPDATE dbo_nro_cliente SET nro_cliente = $proximoNroCliente";
	mysql_query($qry);	
	//return numero de cliente
	return $nroCliente;
}

function obtenerNroTarjeta($nroCliente){
	$nroCliente = str_pad($nroCliente, 8, "0", STR_PAD_LEFT);
	$nroEnte = "620000149";
	$nroEnteCliente = "$nroEnte$nroCliente";
	$digito = obtenerDigito($nroEnteCliente);
	$nro_tarjeta = "$nroEnteCliente$digito";
	return $nro_tarjeta;
}

function asignarNroTarjetaAlLote($nroTarjeta, $lote){
	//TODO: ver si en lote esta el campo nro de tarjeta o crearlo
	//TODO: si el lote ya tiene el numero de tarjeta mandar los datos a un histórico
	$viejaTarjeta = tarjetaAnterior($lote);
	if ($viejaTarjeta != '') pasarLoteAHistorico($lote, $viejaTarjeta);	
	$qry = "UPDATE dbo_Lote SET Lote_tarjeta_pago = '$nroTarjeta'
	 		WHERE Lote_nro = $lote";
	mysql_query($qry); 	
}

function tarjetaAnterior($lote){
	$qry = "SELECT Lote_tarjeta_pago FROM dbo_Lote 
			WHERE Lote_nro = $lote";
	$rs = armar_matriz($qry);
	$tarjeta = $rs[0]['Lote_tarjeta_pago'];
	return $tarjeta;
}

function pasarLoteAHistorico($lote, $viejaTarjeta){
	$hoy = date("Y-m-d");	
	$idUser = $_SESSION["user_id"];
	$qry = "INSERT INTO dbo_lote_historico 
			(Lote_nro, Lote_tarjeta_pago, Fecha_carga, Usuario_carga) 
	VALUES  ($lote, '$viejaTarjeta', '$hoy', $idUser)";
	mysql_query($qry);
}

function obtenerDigito($numero_origen) {
	$num0 = $numero_origen[0] * 3;
	$num1 = $numero_origen[1] * 1;
	$num2 = $numero_origen[2] * 3;
	$num3 = $numero_origen[3] * 1;
	$num4 = $numero_origen[4] * 3;
	$num5 = $numero_origen[5] * 1;
	$num6 = $numero_origen[6] * 3;
	$num7 = $numero_origen[7] * 1;
	$num8 = $numero_origen[8] * 3;
	$num9 = $numero_origen[9] * 1;
	$num10 = $numero_origen[10] * 3;
	$num11 = $numero_origen[11] * 1;
	$num12 = $numero_origen[12] * 3;
	$num13 = $numero_origen[13] * 1;
	$num14 = $numero_origen[14] * 3;
	$num15 = $numero_origen[15] * 1;
	$num16 = $numero_origen[16] * 3;
	
	$suma = $num0+$num1+$num2+$num3+$num4+$num5+$num6+$num7+$num8+$num9+$num10+$num11+$num12+$num13+$num14+$num15+$num16;
	
	$total = $suma/10;
	
	$decimales = explode(".",$total);
	
	$decimal = $decimales[1];
	
	if($decimal != 0){
		$digito = 10-$decimal;
	} else {
		$digito = 0;
	}
	return $digito;

}


$qryFechaGen = "SELECT Fecha_genera_nros_tarjetas
				FROM dbo_resolucion WHERE  Resolucion_nombre LIKE '$nroResolucion'";
$rsFech= armar_matriz($qryFechaGen);
$fechaGen = $rsFech[0]['Fecha_genera_nros_tarjetas'];


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Generar Tarjetas</title>
</head>
<body>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Descargar listado de números de tarjetas de pago <br> Resolucion <?php echo $nroResolucion?></h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<a href="download.php?file=<?php echo "$archivo.txt"?>&fechaGen=<?php echo $fechaGen?>">DESCARGAR LISTADO</a>
</body>