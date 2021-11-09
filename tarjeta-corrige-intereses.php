<table>
<?
$num = '1';

include ("conec.php");
include ("funciones.php");

/*
$sql = "SELECT * FROM dbo_tarjeta WHERE Familia_nro != '0' ORDER BY Tarjeta_numero LIMIT 0,500";
$res = mysql_query($sql);
*/


$sql = "SELECT * FROM dbo_familia WHERE Familia_montoadj != '0' AND Familia_monto_actualizacion != '0' ORDER BY Barrio_nro ASC";

$res = mysql_query($sql);


while($familia = mysql_fetch_array($res)) {
	
$familia_nro = $familia["Familia_nro"];

$barrio_nro = $familia["Barrio_nro"];

$sql2 = "SELECT Tarjeta_nro, Tarjeta_monto_intereses FROM dbo_tarjeta WHERE Familia_nro = $familia_nro";

$res2 = mysql_query($sql2);

$tarjeta = mysql_fetch_array($res2);	

//echo $num.".- ".$familia_nro." - Monto orig: ".$familia["Familia_montoadj"]." - Monto Act: ".$familia["Familia_monto_actualizacion"]." - Intereses: ".$tarjeta["Tarjeta_monto_intereses"]."</br>";

$familia_montoadj = $familia["Familia_montoadj"];

$familia_monto_actualizacion = $familia["Familia_monto_actualizacion"];

$monto_diferencia = $familia_monto_actualizacion - $familia_montoadj;

?>
<tr>
<td
<? if($monto_diferencia < '0') {echo "bgcolor='#EEFCBC'; "; } ?>>
<?



echo $num.".- Barrio: ".$barrio_nro.".- ".$familia_nro." - Monto orig: ".$familia["Familia_montoadj"]." - Monto Act: ".$familia["Familia_monto_actualizacion"]." - Diferencia: ".$monto_diferencia." - Intereses: ".$tarjeta["Tarjeta_monto_intereses"]."</br>";

$num++;
?>
</td></tr>
<?
}
?>
</table>
<strong>Cantidad: <?=$num; ?></strong>