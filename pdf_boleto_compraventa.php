<?php
//============================================================+
//
// Description : Boleto de compraventa en formato pdf que
//               brinda la librería TCPDF.
//
// Nota: Lo dejo preparado para poder generar con esta clase 
//       una plantilla con diferentes reportes. Le falta refactor.
//
//============================================================+

/**
 * Genera un pdf con una lista de boletos de compraventa 
 * con los datos obtenidos de la base directamente con sql.
 *
 * @author mmanto
 */

require_once('controladores/persona_ctrl.php');
require_once('reportes/SinViviendaPorCancelarBCV.php');
require_once('reportes/ConViviendaPorCancelarBCV.php');
require_once('reportes/ConViviendaCanceladoBCV.php');
require_once('reportes/SinViviendaCanceladoBCV.php');
require_once('reportes/ConurbanoBCV.php');
require_once('reportes/AdjudicacionBCV.php');


session_start();

if (!isset($_SESSION["user_id"])) {
    
    header("Location: login.php");
    
}

//============================================================+
// Principal
//============================================================+

// listado de números de familias.

$familias = explode( ",", $_POST['familias'] );

// Datos en común a todos los boletos.
$localidad_boleto = $_POST["localidad_boleto"];
$fecha = $_POST["fecha"];
$tribunales = $_POST["tribunales"];
$vencimiento_primera_cuota = $_POST["ven_pri_cuota"];
$administrador_general = $_POST["administrador_general"];
$nombre_subsecretario = $_POST["nombre_subsecretario"];
$cuotas_automaticas_txt = $_POST["cuotas_automaticas_txt"];

$plano_registrado = "";

$cuotas_automaticas = $_POST['cuotas_automaticas'];

if ($_POST['plano_registrado'] == 'plano_registrado'){
	
	//TODO
	$plano_registrado = "registrado por la Agencia de Recaudación de la provincia de Buenos Aires (ARBA)";
}

if ($cuotas_automaticas == 'cuotas_automaticas'){

//echo("cuotas automaticas: " . $cuotas_automaticas . "!");
	//TODO
	$cuotas_calculadas = true;
}else {
	$cuotas_calculadas = false;
}

$tipo_boleto = $_POST["tipo_boleto"];

if ( $tipo_boleto == 'sin_vivienda_por_cancelar'){

	$bcompra_venta = new SinViviendaPorCancelarBCV(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
}elseif ($tipo_boleto == 'con_vivienda_por_cancelar'){

	$bcompra_venta = new ConViviendaPorCancelarBCV(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
}elseif ($tipo_boleto == 'con_vivienda_cancelado'){

	$bcompra_venta = new ConViviendaCanceladoBCV(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

}elseif ($tipo_boleto == 'sin_vivienda_cancelado'){

	$bcompra_venta = new SinViviendaCanceladoBCV(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

}elseif ($tipo_boleto == 'conurbano'){

	$bcompra_venta = new ConurbanoBCV(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
	
	$bcompra_venta->set_administrador_general( $administrador_general);
	
	$bcompra_venta->set_nombre_subsecretario( $nombre_subsecretario );

}elseif ($tipo_boleto == 'adjudicacion'){

	$bcompra_venta = new AdjudicacionBCV(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
	
	$bcompra_venta->set_administrador_general( $administrador_general);
	
	$bcompra_venta->set_nombre_subsecretario( $nombre_subsecretario );
	
}

$bcompra_venta->armar_consultas( $familias );

// fecha en formato dd/mm/yyyy
list($dia, $mes, $anio) = split('[/.-]', $fecha);

$fecha_en_letras = FechaUtil::fecha_en_palabras( $dia, $mes, $anio );

//$vencimiento_primera_cuota = FechaUtil::fecha_en_palabras_ma( $mes, $anio );
$bcompra_venta->datos_comun( $tribunales, $localidad_boleto, $fecha_en_letras, $vencimiento_primera_cuota, $plano_registrado, $cuotas_calculadas, $cuotas_automaticas_txt);
$bcompra_venta->ejecutar_consultas( $familias );
$bcompra_venta->mostrar();
//

//============================================================+
// Fin principal
//============================================================+
?>
