<?php

if ( !defined('PROJECT_ROOT') ){
    define('PROJECT_ROOT', '/var/www/html/beneficiarios/');
}


include(PROJECT_ROOT . 'controladores/familia_ctrl.php');

$f = FamiliaController::get_familia(110395);

echo "Familia_nro: " . $f->get_familia_nro() . "<br>";
echo "Municipio: " . $f->get_municipio() . "<br>";
echo "Nomenclatura : " . $f->get_nomenclatura(). "<br>";

?>
