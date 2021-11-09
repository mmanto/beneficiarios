<?php

session_start();

defined('PROJECT_ROOT') or define('PROJECT_ROOT', '/var/www/html/beneficiarios/');

if (!isset($_SESSION["user_id"])) {
    
    header("Location: /beneficiarios/login.php");
    
}

require_once(PROJECT_ROOT . 'controladores/persona_ctrl.php');

$integrantes = PersonaController::obtener_integrantes_familia(110395);

foreach( $integrantes as $integrante ){
	echo  $integrante->get_apellido() . ', ' . $integrante->get_nombres();
	echo '<br>';
}

?>