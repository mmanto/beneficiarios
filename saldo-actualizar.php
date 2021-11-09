<?
include ("cabecera.php");
include ("conec.php");

$tarjeta_nro = "620000149000194545";
 
$montopago = "500";


$sql = "SELECT * FROM dbo_familia WHERE Familia_tarjeta_nro = $tarjeta_nro";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);
$familia = mysql_fetch_array($res);

$saldado_ant = $familia["Familia_montoadj_pago"];

$pago_actual = $montopago;

$saldado_total = $saldado_ant + $pago_actual;

if ($cant > 0) {


//$upd = "UPDATE dbo_familia SET Familia_montoadj_pago = '$saldado_total'"

echo "Tarjeta: ".$tarjeta_nro."</p>";
echo "<p>Saldo anterior: ".$saldado_ant."</p>";
echo "<p>Pago: ".$montopago."</p>";
echo "Pagado total: ".$saldado_total."</p>";


} else{ echo "No existe esa tarjeta en el sistema"; }

?>