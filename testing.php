<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?

function redondear_dos_decimal($valor) {
$float_redondeado=round($valor * 100) / 100;
return $float_redondeado;
}

$lote_superficie = '246.38'; 
$lote_valor_m2 = '138.45';
$lote_valor_mensura = '185.3';
$lote_cant_cuotas = '30';

//$lote_superficie = $_POST["lote_superficie"];
//$lote_valor_m2 = $_POST["lote_valor_m2"];
//$lote_valor_mensura = $_POST["lote_valor_mensura"];
$lote_valor_sup = $lote_superficie*$lote_valor_m2;
$lote_valor_total = $lote_valor_sup + $lote_valor_mensura;
$lote_valor_total = redondear_dos_decimal($lote_valor_total);
//if ($_POST["lote_cant_cuotas"]) < '1' {$lote_cant_cuotas = '1';}else{$lote_cant_cuotas = $_POST["lote_cant_cuotas"];}
if ($lote_cant_cuotas < 1) {$lote_cant_cuotas = 1;}else{$lote_cant_cuotas = $lote_cant_cuotas;}
$cant_cuotas_enteras = $lote_cant_cuotas - 1;
$cuota_original = $lote_valor_total/$lote_cant_cuotas;
$lote_valor_cuota_entera = redondear_dos_decimal($cuota_original);
$suma_cuota_enteras = $lote_valor_cuota_entera*$cant_cuotas_enteras;
$lote_valor_ultima_cuota = $lote_valor_total - $suma_cuota_enteras;


////////////////////////////////////////////////////////////////////


echo "Superficie = ".$lote_superficie."<br>";
echo "Valor m2 = ".$lote_valor_m2."<br>";
echo "Valor del lote por superficie = ".$lote_valor_sup."<br>";
echo "Valor mensura = ".$lote_valor_mensura."<br>";
echo "Valor total = ".$lote_valor_total."<br>";
echo "Cantidad cuotas = ".$lote_cant_cuotas."<br>";
echo "Cuota original (con decimales) = ".$cuota_original."<br>";
echo "Valor cuotas redondeada = ".$lote_valor_cuota_entera."<br>";
echo "Ultima cuota = ".$lote_valor_ultima_cuota."<br>";


//echo "Valor anterior redondeado = ".$lote_valor_cuota_entera."<br>";
//echo "Valor de la última cuota = ".$lote_valor_ultima_cuota."<br>";

?>
</body>
</html>
