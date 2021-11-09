<?php
require_once('persona_ctrl.php');

$pc = new PersonaController();

$personas = $pc->obtener_personas(107490);

//$varias_familias = $pc->de_varias_familias(array(107490,107480)); 


foreach ($personas as $p ){
    echo "<br>";
    echo "Persona nacionalidad_: " . $p->get_apellido();
    echo "<br>";
}

/*
echo "de_varias_familias: ";
echo "<br>";
echo "--------------------";
echo "<br>";
foreach($varias_familias as $f){
    foreach ($f as $p){
        echo "Persona nacionalidad: " . $p->get_apellido();
        echo "<br>";
    }
}
echo "--------------------";
*/
?>