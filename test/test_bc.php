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
require_once('reportes/GeneradorBoletosPDF.php');


session_start();

if (!isset($_SESSION["user_id"])) {
    
    header("Location: login.php");
    
}

//============================================================+
// Principal
//============================================================+

// listado de números de familias.

//$familias = explode( ",", $_POST['familias'] );
$familias = ['112491'];

// Datos en común a todos los boletos.
$localidad_boleto = $_POST["localidad_boleto"];
$fecha = $_POST["fecha"];
$tribunales = $_POST["tribunales"];
$vencimiento_primera_cuota = $_POST["ven_pri_cuota"];

$tipo_boleto = $_POST["tipo_boleto"];

if ( $tipo_boleto == 'sin_vivienda_por_cancelar'){

	$bcompra_venta = new BoletoCompraventa(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'es_AR.utf8', false);
	
}

$bcompra_venta->armar_consultas( $familias );

// fecha en formato dd/mm/yyyy
list($dia, $mes, $anio) = split('[/.-]', $fecha);

$fecha_en_letras = FechaUtil::fecha_en_palabras( $dia, $mes, $anio );

//$vencimiento_primera_cuota = FechaUtil::fecha_en_palabras_ma( $mes, $anio );

$bcompra_venta->datos_comun( $tribunales, $localidad_boleto, $fecha_en_letras, $vencimiento_primera_cuota );
$bcompra_venta->ejecutar_consultas( $familias );
$bcompra_venta->mostrar();

//============================================================+
// Fin principal
//============================================================+
?>