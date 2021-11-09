<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");


$sup_comun = $_POST["sup_comun"];
$valorm2_actual = $_POST["valorm2_actual"];
$valor_mensura = $_POST["valor_mensura"];
$valor_lote_protierra = $_POST["valor_lote_protierra"];
$cuotas_cant = $_POST["cuotas_cant"];
$cant = $_POST["cant"];
$idBarrio = $_POST["idBarrio"];

$sql3 = "UPDATE dbo_barrio SET
		Barrio_lote_valor_protierra = '$valor_lote_protierra',
		Barrio_m2_valor_actual = '$valorm2_actual',
		Barrio_mensura_valor = '$valor_mensura',
		Barrio_cuotas_cant = '$cuotas_cant'
		WHERE Barrio_nro = '$idBarrio'";
		
if(!mysql_query($sql3)) { 

?>
<h1>No se pudo actualizar el barrio. Contatce al administrador</h1>
<p>&nbsp;</p>
<p><a href="beneficio_porbarrio_listar.php?idBarrio=<?=$idBarrio; ?>">Volver al listado de beneficiarios</a>
<p>&nbsp;</p>
<? }else{

//********************************//

for ($i=1;$i<=$cant;$i++){ 

$familia_nro = $_POST["id".$i];

$suplote = $_POST["suplote".$i];

$suptotal = $suplote + $sup_comun;

$valor_tierra = $suptotal * $valorm2_actual;

if($valor_lote_protierra != '0') { $valor_total = $valor_lote_protierra; }else{ $valor_total = $valor_tierra + $valor_mensura; }

$valor_cuota = $valor_total/$cuotas_cant;

$valor_cuota_red = round($valor_cuota, 2);


$sql2 = "UPDATE dbo_familia SET
		Lote_superficie = '$suplote',
		Lote_sup_comun = '$sup_comun',
		Lote_sup_total = '$suptotal',
		Lote_m2_valor_origen = '$valorm2_origen',
		Lote_m2_valor_actual = '$valorm2_actual',
		Lote_tierra_valor = '$valor_tierra',
		Lote_mensura_valor = '$valor_mensura',
		Familia_montoadj = '$valor_total',
		Familia_montoadj_cuotas = '$cuotas_cant',
		Familia_montoadj_cuota_valor = '$valor_cuota_red'
		WHERE Familia_nro = '$familia_nro'";
		
mysql_query($sql2); 

}
?>
<h1>Datos actualizados correctamente</h1>
<p>&nbsp;</p>
<p><a href="beneficio_porbarrio_listar.php?idBarrio=<?=$idBarrio; ?>">Volver al listado de beneficiarios</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? } ?>
<? include("pie.php"); ?>