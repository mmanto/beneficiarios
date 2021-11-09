<?php

if ( !defined(PROJECT_ROOT) ){
    define('PROJECT_ROOT', '/var/www/beneficiarios/');
}

require_once(PROJECT_ROOT . 'tcpdf_include.php');
require_once(PROJECT_ROOT . '/controladores/persona_ctrl.php');
require_once(PROJECT_ROOT . '/reportes/GeneradorBoletosPDF.php');


class TestBoletoCompraventaPDF{

    function contraparte_unico_integrante(){
        
        session_start();
        
        if (!isset($_SESSION["user_id"])) {
            
            header("Location: login.php");
            
        }
        
        $familias = array('111320');
        
        // Datos en común a todos los boletos.
        $localidad_boleto = $_POST["localidad_boleto"];
        $fecha = $_POST["fecha"];
        $tribunales = $_POST["tribunales"];
        $vencimiento_primera_cuota = $_POST["ven_pri_cuota"];
        
        $bcompra_venta = new BoletoCompraventa(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'es_AR.utf8', false);
        $bcompra_venta->armar_consultas( $familias );
        
        // fecha en formato dd/mm/yyyy
        list($dia, $mes, $anio) = split('[/.-]', $fecha);
        
        $fecha_en_letras = FechaUtil::fecha_en_palabras( $dia, $mes, $anio );
        
        //$vencimiento_primera_cuota = FechaUtil::fecha_en_palabras_ma( $mes, $anio );
        
        $bcompra_venta->datos_comun( $tribunales, $localidad_boleto, $fecha_en_letras, $vencimiento_primera_cuota );
        $bcompra_venta->ejecutar_consultas( $familias );
        $bcompra_venta->mostrar();
    }
}

$test = new TestBoletoCompraventaPDF();
$test->contraparte_unico_integrante();

?>
