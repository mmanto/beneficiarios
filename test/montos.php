<?php
include_once('../lib/monto_util.php');

$valor = "10.00";
$cifra = new Cifra();
echo $cifra->traducir( $valor );

?>