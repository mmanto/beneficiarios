<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
include ("funciones.php");

include("cabecera.php");
?>
<h1>Expediente enviados a EGG</h1>
<p><a href="sbt-menu.php">Volver al menu</a></p>

<table width="500" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center"><strong>Fecha salida</strong></td>
    <td align="center"><strong>Expediente</strong></td>
    <td align="center"><strong>Detalles</strong></td>
  </tr>
<?


$sql = "SELECT Expte_nro, Expte_mov_fecha FROM dbo_exptes_mov WHERE Expte_destino = '35' ORDER BY Expte_mov_fecha DESC LIMIT 0,150";

$res = mysql_query($sql);

$nn = '1';

while ($movimiento = mysql_fetch_array($res)) {

	
$fecha = cambiaf_a_normal($movimiento["Expte_mov_fecha"]);

$exptenro = $movimiento["Expte_nro"];	
	
$sql2 = "SELECT * FROM dbo_exptes WHERE Expte_nro = $exptenro";

$res2 = mysql_query($sql2);

$expediente = mysql_fetch_array($res2);

$expte_nro = $expediente["Expte_nro"];

//echo $nn.") ".$fecha. " | Expte. <b>".$expediente["Expte_caract"]."-".$expediente["Expte_num"]."/".$expediente["Expte_anio"]." Alc. ".$expediente["Expte_alcance"]."</b></br>"; 

?>
  <tr>
    <td align="center"><?=$fecha; ?></td>
    <td align="center"><? echo $expediente["Expte_caract"]."-".$expediente["Expte_num"]."/".$expediente["Expte_anio"];
	
if($expediente["Expte_alcance"] != '0') {	echo " Alc. ".$expediente["Expte_alcance"]; } ?></td>
    <td align="center"><a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')>[Ver detalles]</a></td>
  </tr>
<?


$nn = $nn+1;
}
?>
</table>
<?


} ?>