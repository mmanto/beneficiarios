<?php

session_start();

defined('PROJECT_ROOT') or define('PROJECT_ROOT', '/var/www/beneficiarios/');

if (!isset($_SESSION["user_id"])) {
    
    header("Location: /beneficiarios/login.php");
    
}

require_once(PROJECT_ROOT . 'reportes/GeneradorEtiquetasPDF.php');
require_once(PROJECT_ROOT . 'controladores/familia_ctrl.php');

$f = FamiliaController::get_familia(110812);

$integrantes = PersonaController::obtener_integrantes_familia(110812);

$qe = new GeneradorEtiquetasPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'es_AR.utf8', false);

$nombres_str = '';

foreach( $integrantes as $integrante ){
		
		$nombres_str .= $integrante->get_apellido() . ', ' . $integrante->get_nombres() . '<br>';  
	}
	
$html = '<div style="text-align:center; ">'.
        '<p style="font-size:xx-large;font-weight: bold; ;">'.
        
	$nombres_str .
	
	'</p><br>'.
        '<label>Municipio de </label>' . 
        '<label style="font-size:x-large;font-weight: bold;">' .
        $f->get_municipio(). '</label><br>'.
        '<br>Nomenclatura catastral: ' . 
        $f->get_nomenclatura() .
        '<br><br></div><hr style="border:1px dashed;"/>';

$qe->agregar_contenido($html);
$qe->agregar_contenido($html);
$qe->agregar_contenido($html);
$qe->agregar_contenido($html);

$qe->mostrar();

?>
