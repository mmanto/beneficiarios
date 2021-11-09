<?php

include "../lib/fecha_util.php";

$dia = "1";
$mes = "10";
$anio = "2017";

echo FechaUtil::fecha_en_palabras($dia, $mes, $anio) . "<br>";

$dia = "12";
$mes = "09";
$anio = "2017";

echo FechaUtil::fecha_en_palabras($dia, $mes, $anio). "<br>";

echo "analisis de fecha dd/mm/yyyy<br>";
$fecha = "21/02/2017";

$fecha = "21/02/1973";
list($mes, $día, $año) = split('[/.-]', $fecha);
echo "Día: $día; Mes: $mes;  Año: $año<br />\n";

echo "";


$date = date_create('2014-11-26');

echo date_format($date, 'd/m/Y');
echo "<br>";

session_start();

echo "PROJECT_ROOT = " . $_SESSION['PROJECT_ROOT'];


?>