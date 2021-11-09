<?


$cadena="21 - 4 A    - D";
 
/* 
$sinespacio=str_replace(" ","",$cadena);

$limpio=str_replace("-","",$sinespacio);

echo $limpio;

echo "</br>";
*/

//$nueva_cadena = ereg_replace("[^A-Za-z0-9]", "", $cadena);

$nueva_cadena1 = ereg_replace("[^0-9]", "", $cadena);
$nueva_cadena2 = ereg_replace("[^A-Za-z]", "", $cadena);

$nueva_cadena2 = strtolower($nueva_cadena2);

$nueva_cadena = $nueva_cadena1.$nueva_cadena2;


echo $nueva_cadena;




?>