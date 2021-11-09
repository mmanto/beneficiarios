<?php

session_start();

defined('PROJECT_ROOT') or define('PROJECT_ROOT', '/var/www/beneficiarios/');

if (!isset($_SESSION["user_id"])) {
    
    header("Location: /beneficiarios/login.php");
    
}

require_once(PROJECT_ROOT . 'reportes/GeneradorEtiquetasPDF.php');
require_once(PROJECT_ROOT . 'controladores/familia_ctrl.php');

$fams_nro = $_POST["seleccion"];

$qe = new GeneradorEtiquetasPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'es_AR.utf8', false);

//$familias = [];

foreach ($fams_nro as $familia_nro ){
    
    $familias[] = FamiliaController::get_familia( $familia_nro );
    
}

foreach ( $familias as $familia ){
    
    $qe->agregar_contenido( $familia );
    
}

$qe->mostrar();

    
?>
