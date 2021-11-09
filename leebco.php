<?

$cadena = "DATOS   0014r00954          51140000000000040287A301496200014900030079       00000049500000000000000000000000007245000  58200000000000000000000000000000000000000000620000149000300793                                          17091200000000000000000000000                  00000000
";
$valida = substr($cadena, 0, 5);
$sucursal = substr($cadena, 28, 4);
$terminal = substr($cadena, 14, 4);
$transaccion = substr($cadena, 42, 6);
$tarjeta = substr($cadena, 164, 18);
$pago = substr($cadena, 81, 7)/100;
$fecha_dia = substr($cadena, 228, 2);
$fecha_mes = substr($cadena, 226, 2);
$fecha_anio = substr($cadena, 224, 2);

if($fecha_anio > 70) { $fecha_anio = "19".$fecha_anio; }else{$fecha_anio = "20".$fecha_anio; }

echo $valida." | ".$tarjeta." - Pago: ".$pago." - Fecha: ".$fecha_dia."/".$fecha_mes."/".$fecha_anio." - Sucursal: ".$sucursal." - Terminal: ".$terminal. " - Transaccion: ".$transaccion;


?>


