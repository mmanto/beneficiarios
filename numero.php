<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
</body>
</html>
<?

//TODO obtener nro cliente
//$qry = "SELECT nro_cliente FROM dbo_nro_cliente";
//$rs = armar_matriz($qry);
//$nroCliente = $rs[0][nro_cliente];
$nroCliente = "29139";

$nroCliente = str_pad($nroCliente, 8, "0", STR_PAD_LEFT);
$nroEnte = "620000149";

$nroEnteCliente = "$nroEnte$nroCliente";

$digito = obtenerDigito($nroEnteCliente);

$nro_tarjeta = "$nroEnteCliente$digito";

echo $nro_tarjeta;


function obtenerDigito($numero_origen) {
	$num0 = $numero_origen[0] * 3;
	$num1 = $numero_origen[1] * 1;
	$num2 = $numero_origen[2] * 3;
	$num3 = $numero_origen[3] * 1;
	$num4 = $numero_origen[4] * 3;
	$num5 = $numero_origen[5] * 1;
	$num6 = $numero_origen[6] * 3;
	$num7 = $numero_origen[7] * 1;
	$num8 = $numero_origen[8] * 3;
	$num9 = $numero_origen[9] * 1;
	$num10 = $numero_origen[10] * 3;
	$num11 = $numero_origen[11] * 1;
	$num12 = $numero_origen[12] * 3;
	$num13 = $numero_origen[13] * 1;
	$num14 = $numero_origen[14] * 3;
	$num15 = $numero_origen[15] * 1;
	$num16 = $numero_origen[16] * 3;
	
	$suma = $num0+$num1+$num2+$num3+$num4+$num5+$num6+$num7+$num8+$num9+$num10+$num11+$num12+$num13+$num14+$num15+$num16;
	
	$total = $suma/10;
	
	$decimales = explode(".",$total);
	
	$decimal = $decimales[1];
	
	if($decimal != 0){
		$digito = 10-$decimal;
	} else {
		$digito = 0;
	}

	return $digito;
}



//TODO: incrementar número de cliente