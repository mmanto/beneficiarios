<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$lapso = dias_transcurridos('2017-08-07','2017-08-11');
$lapso_lic = $lapso+1;


?>


<? echo $lapso_lic; ?>